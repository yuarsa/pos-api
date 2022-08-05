<?php

namespace App\Http\Controllers\v1\Pos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\Master\ProductCategoryContract;
use App\Contracts\Master\ProductContract;
use App\Transformer\v1\Pos\ProductCategoryTransformer;
use App\Contracts\Master\EmployeeContract;
use App\Models\Master\ProductCategory;
use App\Models\Master\Product;
use App\Models\Master\ProductVarian;

/**
 * @group POS
 */
class ProductController extends Controller
{
    protected $productCategoryContract;

    protected $productCategoryTransformer;

    protected $productContract;

    public function __construct(ProductCategoryContract $productCategoryContract, ProductCategoryTransformer $productCategoryTransformer, ProductContract $productContract)
    {
        parent::__construct();

        $this->productCategoryContract = $productCategoryContract;

        $this->productCategoryTransformer = $productCategoryTransformer;

        $this->productContract = $productContract;
    }

    /**
     * @response 200 {
     *      "status": 200,
     *      "message": "Data found",
     *      "data": {}
     * }
     */
    public function getProductPerCategory(EmployeeContract $employeeContract)
    {
        try {
            $user = \Auth::user();

            if($user->type != 'k') {
                return $this->withCustomErrorResponse(422, 'Not cashier user privilege');
            }

            $employee = $employeeContract->find($user->employee_id);

            if($employee) {
                $products = $this->productContract->findBy('prod_outlet_id', $employee->emp_out_id)->get();

                foreach ($products as $key => $value) {
                    $category_id[] = $value->prod_category_id;
                }

                $data = ProductCategory::whereIn('prodcat_id', $category_id)->with(['products' => function($q) use($employee) {
                            $q->where('prod_outlet_id', '=', $employee->emp_out_id); 
                        }])->paginate();    
                   

                // $tempData = [];
                // foreach($data as $key=>$item){
                //     $tempData[] = $item; 
                //     $xx = [];
                //     foreach($products as $k=>$a){
                //         if($a->prod_category_id == $item->prodcat_id){
                //             $xx['data'][] = $a;
                //             $datas=$xx;
                //             $tempData[$key]['products'] = $datas; 
                //         }
                //     }
                // }      
                // return response()->json([
                //     "data" =>[
                //         "data"=>$tempData,
                //     ] ,
                //     "status" => 200
                // ]);
                // $data = product::join('mst_product_categories','mst_products.prod_category_id','=','mst_product_categories.prodcat_id')
                // ->whereIn('prodcat_id', $category_id)->where('prodcat_outlet_id',$employee->emp_out_id)->paginate();
               
            } else {
                $data = [];
            }

            return $this->withCollectionResponse($data, $this->productCategoryTransformer);
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    public function getProductVariant($id)
    {

        try {
            $data = ProductVarian::where([
                ['prodvar_product_id', '=',$id],

            ])
            ->select('prod_name','prodvar_price','val_value_2','val_value')

            ->join('mst_variant_values', 'mst_product_variants.prodvar_value_id','=','mst_variant_values.val_id')
            ->join('mst_products', 'mst_product_variants.prodvar_product_id','=','mst_products.prod_id')

            // ->join('mst_product_variants', 'mst_products.id','=','mst_product_variants.prodvar_product_id')


            // ->join('mst_variants', 'mst_product_variants.prodvar_value_id','=','mst_variants.vars_id')



            ->get();
            return response()->json([
                'data' => $data,

            ],200);


 // dd($all);

            // if($user->type != 'k') {
            //     return $this->withCustomErrorResponse(422, 'Not cashier user privilege');
            // }

            // $employee = $employeeContract->find($user->employee_id);

            // if($employee) {
            //     $data = $this->productCategoryContract->findBy('prodcat_outlet_id', $employee->emp_out_id)->paginate();


            // } else {
            //     $data = [];
            // }

        //     return $this->withCollectionResponse($data, $this->productCategoryTransformer);
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

}
