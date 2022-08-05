<?php

namespace App\Http\Controllers\v1\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Master\EmployeeRequest as EmployeeRequest;
use App\Contracts\Master\EmployeeContract;
use App\Transformer\v1\Master\EmployeeTransformer;
use App\Contracts\Auth\UserContract;
use App\Contracts\Master\OutletContract;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

/**
 * @group Masters
 */
class EmployeeController extends Controller
{
    protected $employeeContract;

    protected $userContract;

    protected $employeeTransformer;

    protected $outletContract;

    protected $uuid = 'emp_id';

    public function __construct(EmployeeContract $employeeContract, UserContract $userContract, EmployeeTransformer $employeeTransformer, OutletContract $outletContract)
    {
        parent::__construct();

        $this->employeeContract = $employeeContract;

        $this->userContract = $userContract;

        $this->employeeTransformer = $employeeTransformer;

        $this->outletContract = $outletContract;
    }

    /**
     * @response 200 {
     *      "status": 200,
     *      "message": "Data found",
     *      "data": {}
     * }
     */
    public function index()
    {
        try {
            $user = \Auth::user();

            if($user->type == 'c' || $user->type == 'm') { // c = tier index user; k= kasir; m= manager
                $outlet = $this->outletContract->findBy('out_comp_id', $user->value_id)->get();

                if(!$outlet) {
                    return $this->notFoundResponse("Outlet doesn't exists");
                }

                foreach ($outlet as $key => $value) {
                    $outlet_id[] = $value->out_id;
                }

                $data = \App\Models\Master\Employee::whereIn('emp_out_id', $outlet_id)->paginate();
            } else if($user->type == 'o') {
                $data = $this->employeeContract->findBy('emp_out_id', $user->value_id)->paginate();
            } else {
                $data = [];
            }

            if($data->isEmpty()) {
                return $this->emptyResponse();
            } else {
                return $this->withCollectionResponse($data, $this->employeeTransformer);
            }
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    /**
     * @queryParam emp_id required UUID. Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa
     * @response 200 {
     *      "status": 200,
     *      "message": "Data found",
     *      "data": {}
     * }
     */
    public function show($id)
    {
        try {
            $data = $this->employeeContract->findBy($this->uuid, $id)->first();

            if(!$data) {
                return $this->notFoundResponse("Employee with id {$id} doesn't exist");
            }

            return $this->withItemResponse($data, $this->employeeTransformer);
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    /**
     * @bodyParam emp_out_id integer required Deskripsi.
     * @bodyParam emp_type string required Deskripsi.
     * @bodyParam emp_name string required Deskripsi.
     * @bodyParam emp_email string required Deskripsi.
     * @bodyParam emp_phone string required Deskripsi.
     * @bodyParam emp_pin string required Deskripsi.
     * @bodyParam emp_enabled boolean required Default true.
     */
    public function store(EmployeeRequest $request)
    {
        \DB::beginTransaction();
        try {
            $data = $this->employeeContract->create($request->all());

            if($data) {
                $user = [
                    'email' => $request->emp_email,
                    'name' => $request->emp_name,
                    'password' => $request->emp_type  == "m" ? Hash::make($request->password) : Hash::make($request->emp_pin),
                    'type' => $request->emp_type,
                    'employee_id' => $data->emp_id,
                    "value_id" => $request->value_id,
                ];

                $this->userContract->create($user);

                \DB::commit();
            }

            return $this->withCustomResponse(201, 'Created data succesfully with id: '.$data->emp_id);
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    /**
     * @queryParam emp_id required UUID. Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa
     * @bodyParam emp_out_id integer required Deskripsi.
     * @bodyParam emp_type string required Deskripsi.
     * @bodyParam emp_name string required Deskripsi.
     * @bodyParam emp_email string required Deskripsi.
     * @bodyParam emp_phone string required Deskripsi.
     * @bodyParam emp_pin string required Deskripsi.
     * @bodyParam emp_enabled boolean required Default true.
     */
    public function update(EmployeeRequest $request, $id)
    {
        try {
            $data = $this->employeeContract->findBy($this->uuid, $id)->first();

            if(!$data) {
                return $this->notFoundResponse("Employee with id {$id} doesn't exist");
            }

            $this->employeeContract->updateBy($this->uuid, $id, $request->all());

            return $this->withCustomResponse(200, "Updated data succesfully with tax id: {$id}");
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    /**
     * @queryParam emp_id required UUID. Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa
     */
    public function destroy($id)
    {
        try {
            $data = $this->employeeContract->findBy($this->uuid, $id)->first();
            $user = $this->userContract->findBy('employee_id', $id)->first();

            if(!$data) {
                return $this->notFoundResponse("Employee with id {$id} doesn't exist");
            }
            if(isset($user)){
                $this->userContract->deleteBy('employee_id', $id);
            }

            $delete = $this->employeeContract->deleteBy($this->uuid, $id);

            return $this->withCustomResponse(200, "Delete data succesfully with employee id: {$id}");
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    public function updateSaldo($id, Request $request){
        try {
            $data = $this->employeeContract->findBy($this->uuid, $id)->first();

            if(!$data) {
                return $this->notFoundResponse("Employee with id {$id} doesn't exist");
            }

            $this->employeeContract->updateBy($this->uuid, $id, $request->all());

            return $this->withCustomResponse(200, $request->saldo);
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }
}
