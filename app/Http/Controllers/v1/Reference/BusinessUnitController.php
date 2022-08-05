<?php

namespace App\Http\Controllers\v1\Reference;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Reference\BusinessUnitRequest as BusinessUnitRequest;
use App\Contracts\Reference\BusinessUnitContract;
use App\Transformer\v1\Reference\BusinessUnitTransformer;

/**
 * @group References
 */
class BusinessUnitController extends Controller
{
    protected $businessUnitContract;

    protected $businessUnitTransformer;

    public function __construct(BusinessUnitContract $businessUnitContract, BusinessUnitTransformer $businessUnitTransformer)
    {
        parent::__construct();
        
        $this->businessUnitContract = $businessUnitContract;

        $this->businessUnitTransformer = $businessUnitTransformer;
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
        $data = $this->businessUnitContract->paginate();

        return $this->withCollectionResponse($data, $this->businessUnitTransformer);
    }

    /**
     * @queryParam ub_id integer ID Unit Bisnis. Example: 11
     * @response 200 {
     *      "status": 200,
     *      "message": "Data found",
     *      "data": {}
     * }
     */
    public function show($id)
    {
        try {
            $data = $this->businessUnitContract->find($id);

            return $this->withItemResponse($data, $this->businessUnitTransformer);
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    /**
     * @bodyParam ub_name string required Deskripsi.
     * @bodyParam ub_description string optional Deskripsi.
     */
    public function store(BusinessUnitRequest $request)
    {
        try {
            $this->businessUnitContract->create($request->all());

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
     * @queryParam ub_id required ID Unit Bisnis. Example: 11
     * @bodyParam ub_name string required Deskripsi.
     * @bodyParam ub_description string optional Deskripsi.
     */    
    public function update(BusinessUnitRequest $request, $id)
    {
        try {
            $businessUnit = $this->businessUnitContract->find($id);

            if(!$businessUnit) {
                return $this->notFoundResponse("Business unit with id {$id} doesn't exist");
            }
            
            $this->businessUnitContract->update($request->all(), $id);

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
     * @queryParam ub_id required ID Unit Bisnis. Example: 11
     */
    public function destroy($id)
    {
        try {
            $businessUnit = $this->businessUnitContract->find($id);

            if(!$businessUnit) {
                return $this->notFoundResponse("Business unit with id {$id} doesn't exist");
            }
            
            $this->businessUnitContract->delete($id);

            return $this->withCustomResponse(200, "Delete data succesfully with customer id: {$id}");
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
        $data = $this->businessUnitContract->get(['ub_id', 'ub_name']);

        if(!$data) {
            return $this->emptyResponse();
        }

        return $this->withCustomResponse(200, 'success', $data);
    }
}