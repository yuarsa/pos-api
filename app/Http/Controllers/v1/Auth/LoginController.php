<?php

namespace App\Http\Controllers\v1\Auth;

use App\Http\Requests\v1\Auth\LoginRequest as LoginRequest;
use App\Http\Controllers\Controller;
use App\Contracts\Auth\UserContract;
use App\Contracts\Auth\OauthAccessTokenContract;
use App\Models\Auth\OauthRefreshToken;
use Illuminate\Support\Facades\Hash;
use Auth;
use Blocktrail\CryptoJSAES\CryptoJSAES;
use App\Models\Master\Employee;

/**
 * @group User Management
 * API's for user management
 */
class LoginController extends Controller
{
    protected $userContract;
    protected $oauthaccesstokenContract;

    public function __construct(UserContract $userContract,OauthAccessTokenContract $oauthaccesstokenContract)
    {
        $this->userContract = $userContract;
        $this->oauthaccesstokenContract = $oauthaccesstokenContract;
    }

    /**
     * @bodyParam email string required Email User
     * @bodyParam password string required Password User
     */
    public function create(LoginRequest $request)
    {
        $email = $request->email;

        $isUser = $this->userContract->findBy('email', $email)->first();

        $password = $this->decryptPassword($request->password);

        $status = Employee::where('emp_email',$email)->first();
        if(isset($status)){
            if ($status->emp_enabled == false){
                return response()->json([
                    "error" => [
                        "message" => "User Inactive",
                        "status" => 422
                    ]
                ],422);
            }
        }

        if($isUser) {
            if(Hash::check($password, $isUser->password)) {
                $client = \Laravel\Passport\Client::where('password_client', true)->first();

                $access = [
                    'grant_type' => 'password',
                    'client_id' => $client->id,
                    'client_secret' => $client->secret,
                    'username' => $email,
                    'password' => $password,
                    'scope' => null
                ];

                $token = $request->create('v1/oauth/token', 'post', $access);

                return app()->dispatch($token);
            } else {
                return $this->withCustomErrorResponse(422, 'Password Incorrect');
            }
        } else {
            return $this->withCustomErrorResponse(422, 'Email doest not exist');
        }
    }

    /**
     * @response 200 {
     *      "status": 200,
     *      "message": "User logged out successfully",
     *      "data": ""
     * }
     */
    public function logout()
    {
        $token = Auth::user()->token();


        OauthRefreshToken::where('access_token_id', $token->id)->update(['revoked' => true]);

        $token->revoke();

        return $this->withCustomResponse(200, 'User logged out successfully', '');
    }

    /**
     * @response 200 {
     *      "status": 200,
     *      "message": "success",
     *      "data": {
     *          "id": 2,
     *          "username": null,
     *          "email": "anu@anune.com",
     *          "name": "PT ANUNE SOPO",
     *          "activation_token": "3fKdnvmftSiQ9d2W7ub5V5HgmeCJYZV6",
     *          "enabled": false,
     *          "type": "c",
     *          "value_id": 2,
     *          "login_at": null,
     *          "created_at": "2019-05-28 10:38:06",
     *          "updated_at": "2019-05-28 10:38:06",
     *          "deleted_at": null
     *      }
     * }
     */
    public function detail()
    {
        $user = Auth::user();

        $data = $this->userContract->with('company')->find($user->id);

        return $this->withCustomResponse(200, 'success', $data);
    }

    private function decryptPassword($password)
    {
        $decrypted = CryptoJSAES::decrypt($password, 'XR3WHXmpDG3cRXJ79JK5YUIID3');

        return $decrypted;
    }
}
