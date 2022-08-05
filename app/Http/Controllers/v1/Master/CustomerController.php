<?php

namespace App\Http\Controllers\v1\Master;

use App\Http\Controllers\Controller;
use App\Contracts\Master\CustomerContract;
use App\Http\Requests\v1\Master\CustomerRequest as CustomerRequest;
use App\Transformer\v1\Master\CustomerTransformer;

/**
 * @group Masters
 */
class CustomerController extends Controller
{
    protected $customerContract;

    protected $customerTransformer;
    
    protected $uuid = 'cus_uuid';

    public function __construct(CustomerContract $customerContract, CustomerTransformer $customerTransformer)
    {
        parent::__construct();

        $this->customerContract = $customerContract;

        $this->customerTransformer = $customerTransformer;
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
        $customer = $this->customerContract->paginate();

        return $this->withCollectionResponse($customer, $this->customerTransformer);
    }

    /**
     * @queryParam cus_uuid required Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa
     */
    public function show($uuid)
    {
        try {
            $data = $this->customerContract->findBy('cus_uuid', $uuid);

            return $this->withCustomResponse(200, 'Success', $data);
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    /**
     * @bodyParam cus_name string required Deskripsi.
     * @bodyParam cus_birthday date optional Deskripsi.
     * @bodyParam cus_email string optional Deskripsi.
     * @bodyParam cus_phone string required Deskripsi.
     * @bodyParam cus_address string optional Deskripsi.
     * @bodyParam cus_prov_code string optional Deskripsi.
     * @bodyParam cus_reg_code string optional Deskripsi.
     * @bodyParam cus_postal_code string required Deskripsi.
     */
    public function store(CustomerRequest $request)
    {
        try {
            $request['cus_comp_id'] = \Auth::user()->value_id;

            $request['cus_code'] = '0001';

            $customer = $this->customerContract->create($request->all());

            return $this->withCustomResponse(201, 'Created data succesfully with customer code: '.$customer->cus_code);
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    /**
     * @queryParam cus_uuid required Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa
     * @bodyParam cus_name string required Deskripsi.
     * @bodyParam cus_birthday date optional Deskripsi.
     * @bodyParam cus_email string optional Deskripsi.
     * @bodyParam cus_phone string required Deskripsi.
     * @bodyParam cus_address string optional Deskripsi.
     * @bodyParam cus_prov_code string optional Deskripsi.
     * @bodyParam cus_reg_code string optional Deskripsi.
     * @bodyParam cus_postal_code string required Deskripsi.
     */
    public function update(CustomerRequest $request, $uuid)
    {
        try {
            $customer = $this->customerContract->findBy($this->uuid, $uuid);

            if(!$customer) {
                return $this->notFoundResponse("Customer with id {$uuid} doesn't exist");
            }
            
            $this->customerContract->updateBy($this->uuid, $uuid, $request->input());

            return $this->withCustomResponse(200, "Updated data succesfully with customer id: {$uuid}");
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    /**
     * @queryParam cus_uuid required Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa
     */
    public function destroy($uuid)
    {
        try {
            $customer = $this->customerContract->findBy('cus_uuid', $uuid);

            if(!$customer) {
                return $this->notFoundResponse("Customer with id {$uuid} doesn't exist");
            }
            
            $update = $this->customerContract->deleteBy($this->uuid, $uuid);

            return $this->withCustomResponse(200, "Delete data succesfully with customer id: {$uuid}");
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

        /**
     * @response 200 {
     *      "status": 200,
     *      "message": "Data found",
     *      "data": {id, name}
     * }
     */
    public function autocomplete()
    {
        try {
            $user = \Auth::user();

            if($user->type == 'c') {
                $customer = $this->customerContract->findBy('cus_comp_id', $user->value_id)->select('cus_id', 'cus_code', 'cus_name')->get();
            } else if($user->type == 's') {
                $customer = $this->customerContract->get(['cus_id', 'cus_code', 'cus_name']);
            } else {
                $customer = '';
            }

            $data = [];
            foreach ($customer as $value) {
                $data[] = [
                    'id' => $value->cus_id,
                    'name' => '['.$value->cus_code .']-'. $value->cus_name
                ];
            }

            return $this->withCustomResponse(200, "Data Found", $data);
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }
}
