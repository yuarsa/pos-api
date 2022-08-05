<?php

namespace App\Http\Controllers\v1\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Master\OutletRequest as OutletRequest;
use App\Contracts\Master\OutletContract;
use App\Transformer\v1\Master\OutletTransformer;

/**
 * @group Masters
 */
class OutletController extends Controller
{
    protected $outletContract;

    protected $outletTransformer;
    
    private $uuid = 'out_uuid';

    public function __construct(OutletContract $outletContract, OutletTransformer $outletTransformer)
    {
        parent::__construct();

        $this->outletContract = $outletContract;

        $this->outletTransformer = $outletTransformer;
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
        $user=\Auth::user();
        $data = $this->outletContract->findBy('out_comp_id', $user->value_id)->orderBy('created_at','ASC')->paginate();
        // $data = $this->outletContract->paginate();
        // dd($data);

        if($data->isEmpty()) {
            return $this->emptyResponse();
        } else {
            return $this->withCollectionResponse($data, $this->outletTransformer);
        }
    }

    /**
     * @queryParam out_uuid required Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa
     */
    public function show($uuid)
    {
        try {
            $data = $this->outletContract->findBy($this->uuid, $uuid)->first();

            if(!$data) {
                return $this->notFoundResponse("Outlet with id {$uuid} doesn't exist");
            }

            return $this->withItemResponse($data, $this->outletTransformer);
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    /**
     * @bodyParam out_name string required Deskripsi.
     * @bodyParam out_email string required Deskripsi.
     * @bodyParam out_phone string required Deskripsi.
     * @bodyParam out_address string optional Deskripsi.
     * @bodyParam out_prov_code string optional Deskripsi.
     * @bodyParam out_reg_code string optional Deskripsi.
     */
    public function store(OutletRequest $request)
    {
        try {
            $request['out_comp_id'] = \Auth::user()->value_id;

            $data = $this->outletContract->create($request->all());

            return $this->withCustomResponse(201, 'Created data succesfully with uuid: '.$data->out_uuid);
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    /**
     * @queryParam out_uuid required Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa
     * @bodyParam out_name string required Deskripsi.
     * @bodyParam out_email string required Deskripsi.
     * @bodyParam out_phone string required Deskripsi.
     * @bodyParam out_address string optional Deskripsi.
     * @bodyParam out_prov_code string optional Deskripsi.
     * @bodyParam out_reg_code string optional Deskripsi.
     */
    public function update(OutletRequest $request, $uuid)
    {
        try {
            $data = $this->outletContract->findBy($this->uuid, $uuid) ->first();

            if(!$data) {
                return $this->notFoundResponse("Outlet with id {$uuid} doesn't exist");
            }
            
            $update = $this->outletContract->updateBy($this->uuid, $uuid, $request->all());

            return $this->withCustomResponse(200, "Updated data succesfully with outlet id: {$uuid}");
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    /**
     * @queryParam out_uuid required Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa
     */
    public function destroy($uuid)
    {
        try {
            $data = $this->outletContract->findBy($this->uuid, $uuid)->first();

            if(!$data) {
                return $this->notFoundResponse("Outlet with id {$uuid} doesn't exist");
            }
            
            $delete = $this->outletContract->deleteBy($this->uuid, $uuid);

            return $this->withCustomResponse(200, "Delete data succesfully with outlet id: {$uuid}");
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
        $data = $this->outletContract->get(['out_id', 'out_name']);

        if(!$data) {
            return $this->emptyResponse();
        }

        return $this->withCustomResponse(200, 'success', $data);
    }
}
