<?php

namespace App\Http\Controllers\v1\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Master\ProductRequest as ProductRequest;
use App\Contracts\Master\ProductContract;
use App\Transformer\v1\Master\ProductTransformer;
use App\Traits\FileUpload;
use DB;
use App\Contracts\Master\ProductWholesalerContract;
// *****************
use App\Contracts\Master\VarianContract;
use App\Contracts\Master\VarianValueContract;
use App\Transformer\v1\Master\VarianTransformer;
use \App\Models\Master\Product;

use App\Contracts\Master\ProductVarianContract;
use App\Transformer\v1\Master\ProductVarianTransformer;
// *****************

/**
 * @group Products
 */
class ProductController extends Controller
{
    use FileUpload;

    protected $productContract;

    protected $productTransformer;

    protected $productWholesalerContract;
    // ********************
    protected $varianContract;

    protected $varianvalueContract;

    protected $varianTransformer;

    protected $productvarianContract;

    protected $productvarianTransformer;
    // ********************

    protected $uuid = 'prod_uuid';

    public function __construct(ProductContract $productContract, ProductTransformer $productTransformer, ProductWholesalerContract $productWholesalerContract, VarianContract $varianContract, VarianValueContract $varianvalueContract, VarianTransformer $varianTransformer, ProductVarianContract $productvarianContract, ProductVarianTransformer $productvarianTransformer)
    {
        parent::__construct();

        $this->productContract = $productContract;

        $this->productTransformer = $productTransformer;

        $this->productWholesalerContract = $productWholesalerContract;
        // ***********************
        $this->varianContract = $varianContract;

        $this->varianvalueContract = $varianvalueContract;

        $this->varianTransformer = $varianTransformer;

        $this->productvarianContract = $productvarianContract;

        $this->productvarianTransformer = $productvarianTransformer;
        // ***********************
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


        $user = \Auth::user();
        $data = $this->productContract->findBy('prod_company_id', $user->value_id)->get();

        //  $data = $this->productContract->withCollectionWithoutPaginationResponse();
        // $data = Product::with(['prodvar' => function($query){
        //     $query->join('mst_variant_values','mst_product_variants.prodvar_value_id','=','mst_variant_values.val_id')
        //     ->join('mst_variants as var1','mst_variant_values.val_variant_id','=','var1.vars_id')
        //     ->join('mst_variants as var2','mst_variant_values.val_variant_2','=','var2.vars_id');}])->get();
        // dd($data);
        if ($data->isEmpty()) {
            return $this->emptyResponse();
        } else {
            return $this->withCollectionWithoutPaginationResponse($data, $this->productTransformer);
        }
    }

    /**
     * @queryParam prod_uuid required Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa
     */
    public function show($id)
    {
        try {
            $data = $this->productContract->findBy($this->uuid, $id)->first();

            if (!$data) {
                return $this->notFoundResponse("Product with id {$id} doesn't exist");
            }

            return $this->withItemResponse($data, $this->productTransformer);
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    /**
     * @bodyParam prod_outlet_id integer required Deskripsi.
     * @bodyParam prod_category_id integer required Deskripsi.
     * @bodyParam prod_merk_id integer required Deskripsi.
     * @bodyParam prod_name string required  Deskripsi.
     * @bodyParam prod_sku string optional Deskripsi.
     * @bodyParam prod_unit string optional Deskripsi.
     * @bodyParam prod_description string optional Deskripsi.
     * @bodyParam prod_price_sell double required Deskripsi.
     * @bodyParam prod_price_purchase double required Deskripsi.
     * @bodyParam prod_serial string optional Deskripsi.
     * @bodyParam prod_barcode string optional Deskripsi.
     * @bodyParam prod_stock integer required Default 0.
     * @bodyParam prod_image file optional Deskripsi.
     * @bodyParam prod_is_sell boolean required Default true.
     * @bodyParam prod_enabled boolean required Default true.
     */
    public function store(ProductRequest $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $request['prod_company_id'] = \Auth::user()->value_id;

            if ($request->has('prod_image')) {
                $image = $this->upload($request->file('prod_image'), 'products', \Auth::user()->value_id);

                $imageUrl = $image;

                $request['prod_image'] = $imageUrl;
            } else {
                $request['prod_image'] = null;
            }

            $product = $this->productContract->create($request->input());

            if ($product) {
                $product_id = $product->prod_id;
 
                if (is_array($request->items_wholesaler)) {
                    $items_wholesaler = $request->items_wholesaler;
                } else {
                    $items_wholesaler = json_decode($request->items_wholesaler, true);
                }

                if ($items_wholesaler) {
                    foreach ($items_wholesaler as $key => $value) {
                        $insert = [
                            'prodwho_product_id' => $product_id,
                            'prodwho_qty_min' => $value['prodwho_qty_min'],
                            'prodwho_qty_max' => $value['prodwho_qty_max'],
                            'prodwho_price' => $value['prodwho_price'],
                            'prodwho_type' => $value['prodwho_type'],
                            'prodwho_enabled' => true,
                        ];

                        $this->productWholesalerContract->create($insert);
                    }
                }

                if (is_array($request->varians)) {
                    $varians = $request->varians;
                } else {
                    $varians = json_decode($request->varians, true);
                }


                if ($varians) {
                    foreach ($varians as $key => $value) {
                        $insert = [

                            'options' => $value['options'],
                            'vars_name' => $value['vars_name'],
                        ];

                        $varian = $this->varianContract->create($insert);
                        $arr[] = $varian->vars_id;
                    }

                    $varian = $this->varianContract->create($insert);
                    $id = $varian->vars_id;





                    if (is_array($request->model_list)) {
                        $model_list = $request->model_list;
                    } else {
                        $model_list = json_decode($request->model_list, true);
                    }

                    foreach ($model_list as $key => $value) {
                        if (isset($arr[1])) {
                            $insert = [

                            'val_variant_id' => $arr[0],
                            'val_value' => $value['tier_index'],
                            'val_variant_id_2' => $arr[1],
                            'val_value_2' => $value['tier_index2'],
                        ];
                        } else {
                            $insert = [

                            'val_variant_id' => $arr[0],
                            'val_value' => $value['tier_index'],
                        ];
                        }
                        
                       
                    // dd($insert);
                        $header = $this->varianvalueContract->create($insert);

                    // $prdvar = $insert['prdvar'];
                        $model_list = $request->model_list;

                        $val_value = $header->val_id;

                        $insert = [
                            'prodvar_product_id' => $product_id,
                            'prodvar_value_id' => $val_value,
                            'prodvar_price' => $value['prodvar_price'],
                            'prodvar_purchase_price' => $value['prodvar_purchase_price'],
                            'prodvar_stock' => $value['prodvar_stock'],

                        ];

                        $this->productvarianContract->create($insert);
                    }
                }else{
                    $varian=null;
                }
                
            }
            DB::commit();
            return $this->withCustomResponse(201, 'Created data Products succesfully');
        } catch (QueryException $qe) {
            DB::rollback();
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            DB::rollback();
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            DB::rollback();
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }


    /**
     * @queryParam prod_uuid required Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa
     * @bodyParam prod_outlet_id integer required Deskripsi.
     * @bodyParam prod_category_id integer required Deskripsi.
     * @bodyParam prod_merk_id integer required Deskripsi.
     * @bodyParam prod_name string required  Deskripsi.
     * @bodyParam prod_sku string optional Deskripsi.
     * @bodyParam prod_unit string optional Deskripsi.
     * @bodyParam prod_description string optional Deskripsi.
     * @bodyParam prod_price_sell double required Deskripsi.
     * @bodyParam prod_price_purchase double required Deskripsi.
     * @bodyParam prod_serial string optional Deskripsi.
     * @bodyParam prod_barcode string optional Deskripsi.
     * @bodyParam prod_stock integer required Default 0.
     * @bodyParam prod_image file optional Deskripsi.
     * @bodyParam prod_is_sell boolean required Default true.
     * @bodyParam prod_enabled boolean required Default true.
     */
    public function update(ProductRequest $request, $id)
    {
        
        DB::beginTransaction();
        try {
            $data = $this->productContract->findBy($this->uuid, $id)->first();



            if (!$data) {
                return $this->notFoundResponse("Product Merk with id {$id} doesn't exist");
            }

            $prodvar = $this->productvarianContract->findBy('prodvar_product_id', $data->prod_id)->get()->toArray();

            foreach ($prodvar as $key => $value2) {


              $valvalue = $this->varianvalueContract->findBy('val_id',$value2['prodvar_value_id'])->get()->toArray();


              foreach ($valvalue as $key => $value) {
        
               $this->varianContract->deleteBy('vars_id',$value['val_variant_id']);
               $this->varianContract->deleteBy('vars_id',$value['val_variant_id_2']);

          

           }
           
           $this->varianvalueContract->deleteBy('val_id',$value2['prodvar_value_id']);

       }
        $this->productvarianContract->deleteBy('prodvar_product_id', $data->prod_id);


       if ($request->has('prod_image')) {
        $image = $this->upload($request->file('prod_image'), 'products', \Auth::user()->value_id);

        $imageUrl = env('APP_URL') . '/public/storage/' . $image;

        $request['prod_image'] = $imageUrl;
    } else {
        $request['prod_image'] = $data->prod_image;
    }

    $header = $this->productContract->updateBy($this->uuid, $id, $request->input());

    if ($header) {
        $this->productWholesalerContract->deleteBy('prodwho_product_id', $data->prod_id);

        $items_wholesaler = $request->items_wholesaler;

        if ($items_wholesaler) {
            foreach ($items_wholesaler as $key => $value) {
                $insert = [
                    'prodwho_product_id' => $data->prod_id,
                    'prodwho_qty_min' => $value['prodwho_qty_min'],
                    'prodwho_qty_max' => $value['prodwho_qty_max'],
                    'prodwho_price' => $value['prodwho_price'],
                    'prodwho_type' => $value['prodwho_type'],
                    'prodwho_enabled' => true,
                ];

                $this->productWholesalerContract->create($insert);
            }


        }
        if (is_array($request->varians)) {
            $varians = $request->varians;
        } else {
            $varians = json_decode($request->varians, true);
        }


        if ($varians) {
            foreach ($varians as $key => $value) {
                $insert = [

                    'options' => $value['options'],
                    'vars_name' => $value['vars_name'],
                ];

                $varian = $this->varianContract->create($insert);
                $arr[] = $varian->vars_id;
            }

            $varian = $this->varianContract->create($insert);
            $id = $varian->vars_id;





            if (is_array($request->model_list)) {
                $model_list = $request->model_list;
            } else {
                $model_list = json_decode($request->model_list, true);
            }

            foreach ($model_list as $key => $value) {
                if (isset($arr[1])) {
                    $insert = [

                    'val_variant_id' => $arr[0],
                    'val_value' => $value['tier_index'],
                    'val_variant_id_2' => $arr[1],
                    'val_value_2' => $value['tier_index2'],
                ];
                } else {
                    $insert = [

                    'val_variant_id' => $arr[0],
                    'val_value' => $value['tier_index'],
                ];
                }

                $header = $this->varianvalueContract->create($insert);

                $model_list = $request->model_list;

                $val_value = $header->val_id;

                $insert = [
                    'prodvar_product_id' => $data->prod_id,
                    'prodvar_value_id' => $val_value,
                    'prodvar_price' => $value['prodvar_price'],
                    'prodvar_purchase_price' => $value['prodvar_purchase_price'],
                    'prodvar_stock' => $value['prodvar_stock'],

                ];

                $this->productvarianContract->create($insert);
            }
        }else{
            $varian=null;
        }
        DB::commit();

        return $this->withCustomResponse(200, 'Update data product succesfully with id: ' . $data->prod_uuid);

        }
    } catch (QueryException $qe) {
    DB::rollback();
    return $this->withCustomErrorResponse(422, $qe->getMessage());
    } catch (ModelNotFoundException $mnfe) {
    DB::rollback();
    return $this->withCustomErrorResponse(422, $mnfe->getMessage());
    } catch (\Exception $e) {
    DB::rollback();
    return $this->withCustomErrorResponse(500, $e->getMessage());
    }
}

    /**
     * @queryParam prod_uuid required Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $data = $this->productContract->findBy($this->uuid, $id)->first();

            if (!$data) {
                return $this->notFoundResponse("Product with id {$id} doesn't exist");
            }

            $delete = $this->productContract->deleteBy($this->uuid, $id);

            if ($delete) {
                $this->productWholesalerContract->deleteBy('prodwho_product_id', $data->prod_id);

                DB::commit();

                return $this->withCustomResponse(200, "Delete data succesfully with product id: {$id}");
            }
        } catch (QueryException $qe) {
            DB::rollback();
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            DB::rollback();
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            DB::rollback();
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    /**
     * @queryParam prod_uuid required Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa
     * @bodyParam prod_enabled boolean required Default true.
     */
    public function setStatusProduct(Request $request, $id)
    {
        try {
            $data = $this->productContract->findBy($this->uuid, $id)->first();

            if (!$data) {
                return $this->notFoundResponse("Product with id {$id} doesn't exist");
            }

            $update = $this->productContract->updateBy($this->uuid, $id, $request->all());

            return $this->withCustomResponse(200, "Update status data produk succesfully with product id: {$id}");
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
        try {
            $user = \Auth::user();

            if ($user->type == 'c') {
                $product = $this->productContract->findBy('prod_company_id', $user->value_id)->get();
            } else if ($user->type == 'o') {
                $product = $this->productContract->findBy('prod_outlet_id', $user->value_id)->get();
            } else if ($user->type == 's') {
                $product = $this->productContract->get();
            } else {
                $product = [];
            }

            $data = [];
            foreach ($product as $value) {
                $data[] = [
                    'id' => $value->prod_id,
                    'name' => '[' . $value->category->prodcat_code . '-' . $value->merk->prodmerk_name . ']-' . $value->prod_name,
                    'unit' => $value->prod_unit,
                    'price_sell' => $value->prod_price_sell,
                    'price_purchase' => $value->prod_price_purchase,
                ];
            }

            return $this->withCustomResponse(200, "Data Found", $data);
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }
}
