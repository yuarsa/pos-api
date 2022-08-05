<?php

namespace App\Http\Controllers\v1\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\Master\MarketplaceContract;
use App\Transformer\v1\Master\MarketplaceTransformer;

/**
 * @group Masters
 */
class MarketplaceController extends Controller
{
    protected $marketplaceContract;

    protected $marketplaceTransformer;

    public function __construct(MarketplaceContract $marketplaceContract, MarketplaceTransformer $marketplaceTransformer)
    {
        parent::__construct();

        $this->marketplaceContract = $marketplaceContract;

        $this->marketplaceTransformer = $marketplaceTransformer;
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
        $data = $this->marketplaceContract->paginate();

        if($data->isEmpty()) {
            return $this->emptyResponse();
        } else {
            return $this->withCollectionResponse($data, $this->marketplaceTransformer);
        }
    }

    /**
     * @queryParam market_id required ID.
     * @response 200 {
     *      "status": 200,
     *      "message": "Data found",
     *      "data": {}
     * }
     */
    public function show($id)
    {
        try {
            $data = $this->marketplaceContract->find($id);

            if(!$data) {
                return $this->notFoundResponse("Marketplace with id {$id} doesn't exist");
            }

            return $this->withItemResponse($data, $this->marketplaceTransformer);
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    /**
     *
     */
    public function store(Request $request)
    {
        try {
            $data = $this->marketplaceContract->create($request->all());

            return $this->withCustomResponse(201, 'Created data succesfully with id: '.$data->market_id);
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
    public function update(Request $request, $id)
    {
        try {
            $data = $this->marketplaceContract->find($id);

            if(!$data) {
                return $this->notFoundResponse("Marketplace with id {$id} doesn't exist");
            }

            $update = $this->marketplaceContract->update($request->all(), $id);

            return $this->withCustomResponse(200, "Updated data succesfully with market id: {$id}");
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
            $data = $this->marketplaceContract->find($id);

            if(!$data) {
                return $this->notFoundResponse("Marketplace with id {$id} doesn't exist");
            }

            $delete = $this->marketplaceContract->delete($id);

            return $this->withCustomResponse(200, "Delete data succesfully with market id: {$id}");
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }
}
