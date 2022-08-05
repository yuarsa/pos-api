<?php

namespace App\Http\Controllers\v1\Master;

use App\Http\Controllers\Controller;
use App\Contracts\Master\ProductVarianContract;
use App\Transformer\v1\Master\ProductVarianTransformer;
use App\Models\Master\ProductVarian;
use Illuminate\Support\Facades\DB;

/**
 * @group Products
 */
class ProductVarianController extends Controller
{
    protected $productVarianContract;

    protected $productVarianTransformer;

    protected $uuid = 'prodVarian_uuid';

    public function __construct(ProductVarianContract $productVarianContract, ProductVarianTransformer $productVarianTransformer)
    {
        parent::__construct();

        $this->productVarianContract = $productVarianContract;

        $this->productVarianTransformer = $productVarianTransformer;
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
       
        $productvarian=DB::table('mst_product_variants')
        ->join('mst_variant_values', 'mst_product_variants.prodvar_value_id', '=', 'mst_variant_values.val_id')
        ->join('mst_variants', 'mst_variant_values.val_variant_id', '=', 'mst_variants.vars_id')
        ->get();

        $productvarian2=DB::table('mst_product_variants')
        ->join('mst_variant_values', 'mst_product_variants.prodvar_value_id', '=', 'mst_variant_values.val_id')
        ->join('mst_variants', 'mst_variant_values.val_variant_id_2', '=', 'mst_variants.vars_id')
       
        ->get();


        return response()->json([
            'productvarian' => $productvarian,
            'productvarian2' => $productvarian2,

        ],200);

        if($productvarian->isEmpty()) {
            return $this->emptyResponse();
        } else {
            // dd($data);
            return $this->withCollectionResponse($productvarian, $this->productVarianTransformer);
        }
    }

    /**
     * @queryParam prodVarian_uuid required Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa
     */
    public function show($id)
    {
        try {
            $data = $this->productVarianContract->findBy($this->uuid, $id)->first();

            if(!$data) {
                return $this->notFoundResponse("Product Varian with id {$id} doesn't exist");
            }

            return $this->withItemResponse($data, $this->productVarianTransformer);
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    /**
     * @bodyParam prodVarian_outlet_id integer required Deskripsi.
     * @bodyParam prodVarian_name string required Deskripsi.
     * @bodyParam prodVarian_description string optional Deskripsi.
     */
    public function store(ProductVarianRequest $request)
    {
        try {
            $request['prodVarian_company_id'] = \Auth::user()->value_id;

            $data = $this->productVarianContract->create($request->all());

            return $this->withCustomResponse(201, 'Created data succesfully with id: '.$data->prodVarian_uuid);
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    /**
     * @queryParam prodVarian_uuid required Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa
     * @bodyParam prodVarian_outlet_id integer required Deskripsi.
     * @bodyParam prodVarian_name string required Deskripsi.
     * @bodyParam prodVarian_description string optional Deskripsi.
     */
    public function update(ProductVarianRequest $request, $id)
    {
        try {
            $data = $this->productVarianContract->findBy($this->uuid, $id)->first();

            if(!$data) {
                return $this->notFoundResponse("Product Varian with id {$id} doesn't exist");
            }
            
            $update = $this->productVarianContract->updateBy($this->uuid, $id, $request->all());

            return $this->withCustomResponse(200, "Updated data succesfully with produk Varian id: {$id}");
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    /**
     * @queryParam prodVarian_uuid required Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa
     */
    public function destroy($id)
    {
        try {
            $data = $this->productVarianContract->findBy($this->uuid, $id)->first();

            if(!$data) {
                return $this->notFoundResponse("Product Varian with id {$id} doesn't exist");
            }
            
            $delete = $this->productVarianContract->deleteBy($this->uuid, $id);

            return $this->withCustomResponse(200, "Delete data succesfully with product Varian id: {$id}");
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }
}
