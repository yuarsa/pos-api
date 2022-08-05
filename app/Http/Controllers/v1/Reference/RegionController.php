<?php

namespace App\Http\Controllers\v1\Reference;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Reference\RegionRequest as RegionRequest;
use App\Contracts\Reference\RegionContract;
use App\Transformer\v1\Reference\RegionTransformer;

/**
 * @group References
 */
class RegionController extends Controller
{
    protected $regionContract;

    protected $regionTransformer;

    public function __construct(RegionContract $regionContract, RegionTransformer $regionTransformer)
    { 
        parent::__construct();

        $this->regionContract = $regionContract;

        $this->regionTransformer = $regionTransformer;
    }

    public function index()
    {
        $data = $this->regionContract->paginate();

        return $this->withCollectionResponse($data, $this->regionTransformer);
    }

    /**
     * @queryParam user_id required The id of the user. Example: me
     * @bodyParam reg_code string required The title of the post.
     * @bodyParam reg_prov_code string required The title of the post.
     * @bodyParam reg_name string required The title of the post.
     */
    public function store(RegionRequest $request)
    {
        try {
            $this->regionContract->create($request->all());

            return $this->withCustomResponse(201, 'Created data succesfully');
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $data = $this->regionContract->find($id);

            if(!$data) {
                return $this->notFoundResponse("Region with id {$id} doesn't exist");
            }

            return $this->withItemResponse($data, $this->regionTransformer);
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    public function update(RegionRequest $request, $id)
    {
        try {
            $data = $this->regionContract->find($id);

            if(!$data) {
                return $this->notFoundResponse("Region with id {$id} doesn't exist");
            }
            
            $this->regionContract->update($request->all(), $id);

            return $this->withCustomResponse(200, "Updated data succesfully");
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $data = $this->regionContract->find($id);

            if(!$data) {
                return $this->notFoundResponse("Business unit with id {$id} doesn't exist");
            }
            
            $this->regionContract->delete($id);

            return $this->withCustomResponse(200, "Delete data succesfully with province id: {$id}");
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    public function autocomplete($province_id)
    {
        try {
            $data = $this->regionContract->findBy('reg_prov_code', $province_id)->select('reg_code as code', 'reg_name as name')->get()->toArray();

            if(empty($data)) {
                return $this->notFoundResponse("Province id: {$province_id} in regions doesn't exist");
            }

            return $this->withCustomResponse(200, 'Data Found', ['data' => $data]);
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }
}