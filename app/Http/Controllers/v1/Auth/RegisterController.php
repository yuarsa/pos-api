<?php

namespace App\Http\Controllers\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Auth\RegisterRequest as RegisterRequest;
use App\Contracts\Master\CompanyContract;
use App\Contracts\Master\EmployeeContract;
use App\Contracts\Auth\UserContract;
use Illuminate\Support\Facades\Hash;
use App\Events\Auth\RegisterEvent;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Contracts\Master\OutletContract;
use DB;

/**
 * @group User Management
 * API's for user management
 */
class RegisterController extends Controller
{
    protected $companyContract;

    protected $outletContract;

    protected $userContract;

    protected $employeeContract;

    public function __construct(
        CompanyContract $companyContract,
        OutletContract $outletContract,
        UserContract $userContract,
        EmployeeContract $employeeContract
    ) {
        $this->companyContract = $companyContract;
        $this->outletContract = $outletContract;
        $this->userContract = $userContract;
        $this->employeeContract = $employeeContract;
    }

    /**
     * @bodyParam comp_ub_id integer required Jenis Usaha
     * @bodyParam comp_name string required Nama Usaha/ Toko
     * @bodyParam comp_email string required Email Usaha/ Toko
     * @bodyParam comp_phone string required Telepon Usaha/ Toko
     * @bodyParam password string required Password User
     */
    public function create(RegisterRequest $request)
    {

        DB::beginTransaction();
        try {
            $company = $this->companyContract->create($request->except('password'));

            $inputOutlet = [
                'out_comp_id' => $company->comp_id,
                'out_name' => 'Outlet 1',
                'out_email' => $request->comp_email,
                'out_phone' => '0000',
            ];

           $outlet = $this->outletContract->create($inputOutlet);

            $inputUser = [
                'email' => $request->comp_email,
                'name' => $request->comp_name,
                'password' => Hash::make($request->password),
                'activation_token' => str_random(32),
                'type' => 'c',
                'value_id' => $company->comp_id,
            ];

            $user = $this->userContract->create($inputUser);

            // if($user) {
            //     event(new RegisterEvent($user, $company));
            // }

            DB::commit();

            return $this->withCustomResponse(201, 'Created data succesfully');
        } catch (QueryException $qe) {
            DB::rollBack();

            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            DB::rollBack();

            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }
}
