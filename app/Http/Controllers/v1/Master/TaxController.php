<?php

namespace App\Http\Controllers\v1\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Master\TaxRequest as TaxRequest;
use App\Contracts\Master\TaxContract;
use App\Transformer\v1\Master\TaxTransformer;

/**
 * @group Masters
 */
class TaxController extends Controller
{
    protected $taxContract;

    protected $taxTransformer;

    public function __construct(TaxContract $taxContract, TaxTransformer $taxTransformer)
    {
        parent::__construct();

        $this->taxContract = $taxContract;

        $this->taxTransformer = $taxTransformer;
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
        $data = $this->taxContract->paginate();

        if($data->isEmpty()) {
            return $this->emptyResponse();
        } else {
            return $this->withCollectionResponse($data, $this->taxTransformer);
        }
    }

    /**
     * @queryParam tax_uuid required UUID. Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa
     * @response 200 {
     *      "status": 200,
     *      "message": "Data found",
     *      "data": {}
     * }
     */    
    public function show($id)
    {
        try {
            $data = $this->taxContract->find($id);

            if(!$data) {
                return $this->notFoundResponse("Tax with id {$id} doesn't exist");
            }

            return $this->withItemResponse($data, $this->taxTransformer);
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    /**
     * @bodyParam tax_name string required Deskripsi.
     * @bodyParam tax_rate decimal required Deskripsi.
     */
    public function store(TaxRequest $request)
    {
        try {
            $request['tax_comp_id'] = \Auth::user()->value_id;

            $data = $this->taxContract->create($request->all());

            return $this->withCustomResponse(201, 'Created data succesfully with id: '.$data->tax_id);
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    /**
     * @queryParam tax_uuid required UUID. Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa
     * @bodyParam tax_name string required Deskripsi.
     * @bodyParam tax_rate decimal required Deskripsi.
     */
    public function update(TaxRequest $request, $id)
    {
        try {
            $data = $this->taxContract->find($id);

            if(!$data) {
                return $this->notFoundResponse("Tax with id {$id} doesn't exist");
            }
            
            $update = $this->taxContract->update($request->all(), $id);

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
     * @queryParam tax_uuid required UUID. Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa
     */
    public function destroy($id)
    {
        try {
            $data = $this->taxContract->find($id);

            if(!$data) {
                return $this->notFoundResponse("Tax with id {$id} doesn't exist");
            }
            
            $delete = $this->taxContract->delete($id);

            return $this->withCustomResponse(200, "Delete data succesfully with tax id: {$id}");
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }
}
