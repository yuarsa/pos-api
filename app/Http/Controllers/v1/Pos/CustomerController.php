<?php

namespace App\Http\Controllers\v1\Pos;

use Illuminate\Http\Request;
use App\Http\Requests\v1\Master\CustomerRequest as CustomerRequest;
use App\Http\Controllers\Controller;
use App\Contracts\Master\CustomerContract;
use App\Transformer\v1\Pos\CustomerTransformer;

/**
 * @group POS
 */
class CustomerController extends Controller
{
    protected $customerContract;

    protected $customerTransformer;

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
    public function index($company_id)
    {
        try {

            $data = $this->customerContract->findBy('cus_comp_id', $company_id)->paginate();

            if($data->isEmpty()) {
                return $this->emptyResponse();
            } else {
                return $this->withCollectionResponse($data, $this->customerTransformer);
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
     * @bodyParam cus_comp_id integer required Deskripsi.
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
            $request['cus_code'] = '0000';

            $data = $this->customerContract->create($request->all());

            return $this->withCustomResponse(201, 'Created data succesfully with customer id: '.$data->cus_uuid);
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }
}