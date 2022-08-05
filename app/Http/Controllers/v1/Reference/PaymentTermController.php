<?php

namespace App\Http\Controllers\v1\Reference;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Reference\ProvinceRequest as ProvinceRequest;
use App\Contracts\Reference\PaymentTermContract;
use App\Transformer\v1\Reference\PaymentTermTransformer;

/**
 * @group References
 */
class PaymentTermController extends Controller
{
    protected $paymentTermContract;

    protected $paymentTermTransformer;

    public function __construct(PaymentTermContract $paymentTermContract, PaymentTermTransformer $paymentTermTransformer)
    { 
        parent::__construct();

        $this->paymentTermContract = $paymentTermContract;

        $this->paymentTermTransformer = $paymentTermTransformer;
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
        $data = $this->paymentTermContract->paginate();

        return $this->withCollectionResponse($data, $this->paymentTermTransformer);
    }

    /**
     * @bodyParam prov_code string required Deskripsi.
     * @bodyParam prov_name string required Deskripsi.
     */
    public function store(ProvinceRequest $request)
    {
        try {
            $this->paymentTermContract->create($request->all());

            return $this->withCustomResponse(201, 'Created data succesfully');
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    /**
     * @queryParam prov_code required kode provinsi. Example: 11
     * @response 200 {
     *      "status": 200,
     *      "message": "Data found",
     *      "data": {}
     * }
     */
    public function show($id)
    {
        try {
            $data = $this->paymentTermContract->find($id);

            return $this->withItemResponse($data, $this->paymentTermTransformer);
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    /**
     * @queryParam prov_code required kode provinsi. Example: 11
     * @bodyParam prov_code string required Deskripsi.
     * @bodyParam prov_name string required Deskripsi.
     */
    public function update(ProvinceRequest $request, $id)
    {
        try {
            $province = $this->paymentTermContract->find($id);

            if(!$province) {
                return $this->notFoundResponse("Payment Term with id {$id} doesn't exist");
            }
            
            $this->paymentTermContract->update($request->all(), $id);

            return $this->withCustomResponse(200, "Updated data succesfully");
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    /**
     * @queryParam prov_code required kode provinsi. Example: 11
     */
    public function destroy($id)
    {
        try {
            $province = $this->paymentTermContract->find($id);

            if(!$province) {
                return $this->notFoundResponse("Payment Term with id {$id} doesn't exist");
            }
            
            $this->paymentTermContract->delete($id);

            return $this->withCustomResponse(200, "Delete data succesfully with id: {$id}");
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    public function autocomplete()
    {
        $data = $this->paymentTermContract->get(['payterm_id', 'payterm_name']);

        if(!$data) {
            return $this->emptyResponse();
        }

        return $this->withCustomResponse(200, 'success', $data);
    }
}