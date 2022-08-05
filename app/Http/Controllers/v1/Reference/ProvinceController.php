<?php

namespace App\Http\Controllers\v1\Reference;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Reference\ProvinceRequest as ProvinceRequest;
use App\Contracts\Reference\ProvinceContract;
use App\Transformer\v1\Reference\ProvinceTransformer;

/**
 * @group References
 */
class ProvinceController extends Controller
{
    protected $provinceContract;

    protected $provinceTransformer;

    public function __construct(ProvinceContract $provinceContract, ProvinceTransformer $provinceTransformer)
    { 
        parent::__construct();

        $this->provinceContract = $provinceContract;

        $this->provinceTransformer = $provinceTransformer;
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
        $province = $this->provinceContract->paginate();

        return $this->withCollectionResponse($province, $this->provinceTransformer);
    }

    /**
     * @bodyParam prov_code string required Deskripsi.
     * @bodyParam prov_name string required Deskripsi.
     */
    public function store(ProvinceRequest $request)
    {
        try {
            $this->provinceContract->create($request->all());

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
            $data = $this->provinceContract->find($id);

            return $this->withItemResponse($data, $this->provinceTransformer);
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
            $province = $this->provinceContract->find($id);

            if(!$province) {
                return $this->notFoundResponse("Province with id {$id} doesn't exist");
            }
            
            $this->provinceContract->update($request->all(), $id);

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
            $province = $this->provinceContract->find($id);

            if(!$province) {
                return $this->notFoundResponse("Business unit with id {$id} doesn't exist");
            }
            
            $this->provinceContract->delete($id);

            return $this->withCustomResponse(200, "Delete data succesfully with province id: {$id}");
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
        $data = $this->provinceContract->get(['prov_code', 'prov_name']);

        if(!$data) {
            return $this->emptyResponse();
        }

        return $this->withCustomResponse(200, 'success', $data);
    }
}