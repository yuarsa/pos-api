<?php

namespace App\Http\Controllers\v1\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Master\ProductMerkRequest as ProductMerkRequest;
use App\Contracts\Master\ProductMerkContract;
use App\Transformer\v1\Master\ProductMerkTransformer;

/**
 * @group Products
 */
class ProductMerkController extends Controller
{
    protected $productMerkContract;

    protected $productMerkTransformer;

    protected $uuid = 'prodmerk_uuid';

    public function __construct(ProductMerkContract $productMerkContract, ProductMerkTransformer $productMerkTransformer)
    {
        parent::__construct();

        $this->productMerkContract = $productMerkContract;

        $this->productMerkTransformer = $productMerkTransformer;
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
        $data = $this->productMerkContract->findBy('prodmerk_company_id', $user->value_id)->paginate();
        
        // $data = $this->productMerkContract->paginate();
// dd($data);
        if($data->isEmpty()) {
            return $this->emptyResponse();
        } else {
            return $this->withCollectionResponse($data, $this->productMerkTransformer);
        }
    }

    /**
     * @queryParam prodmerk_uuid required Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa
     */
    public function show($id)
    {
        try {
            $data = $this->productMerkContract->findBy($this->uuid, $id)->first();

            if(!$data) {
                return $this->notFoundResponse("Product Merk with id {$id} doesn't exist");
            }

            return $this->withItemResponse($data, $this->productMerkTransformer);
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    /**
     * @bodyParam prodmerk_outlet_id integer required Deskripsi.
     * @bodyParam prodmerk_name string required Deskripsi.
     * @bodyParam prodmerk_description string optional Deskripsi.
     */
    public function store(ProductMerkRequest $request)
    {
        try {
            $request['prodmerk_company_id'] = \Auth::user()->value_id;

            $data = $this->productMerkContract->create($request->all());

            return $this->withCustomResponse(201, 'Created data succesfully with id: '.$data->prodmerk_uuid);
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    /**
     * @queryParam prodmerk_uuid required Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa
     * @bodyParam prodmerk_outlet_id integer required Deskripsi.
     * @bodyParam prodmerk_name string required Deskripsi.
     * @bodyParam prodmerk_description string optional Deskripsi.
     */
    public function update(ProductMerkRequest $request, $id)
    {
        try {
            $data = $this->productMerkContract->findBy($this->uuid, $id)->first();

            if(!$data) {
                return $this->notFoundResponse("Product Merk with id {$id} doesn't exist");
            }
            
            $update = $this->productMerkContract->updateBy($this->uuid, $id, $request->all());

            return $this->withCustomResponse(200, "Updated data succesfully with produk merk id: {$id}");
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    /**
     * @queryParam prodmerk_uuid required Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa
     */
    public function destroy($id)
    {
        try {
            $data = $this->productMerkContract->findBy($this->uuid, $id)->first();

            if(!$data) {
                return $this->notFoundResponse("Product merk with id {$id} doesn't exist");
            }
            
            $delete = $this->productMerkContract->deleteBy($this->uuid, $id);

            return $this->withCustomResponse(200, "Delete data succesfully with product merk id: {$id}");
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }
}
