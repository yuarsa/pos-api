<?php

namespace App\Http\Controllers\v1\Pos;

use Illuminate\Http\Request;
use App\Http\Requests\v1\Transaction\SaleRequest as SaleRequest;
use App\Http\Requests\v1\Transaction\SaleDetailRequest as SaleDetailRequest;
use App\Http\Controllers\Controller;
use App\Contracts\Transaction\SaleOrderContract;
use App\Contracts\Transaction\SaleOrderDetailContract;
use App\Contracts\Transaction\TransactionContract;
use App\Contracts\Master\EmployeeContract;
use App\Contracts\Transaction\TransactionDetailContract;
use DB;
use App\Transformer\v1\Pos\SaleIncludeTransformer;
use App\Models\Master\KasirModal;
use Illuminate\Support\Carbon;
use App\Models\Master\VarianValue;
use App\Models\Master\Varian;
use App\Models\Master\Outlet;
use App\Models\Master\Company;
use App\Models\Master\Employee;
use App\Models\Transaction\Sale;
use App\Models\Transaction\SaleDetail;
use App\Models\Master\ProductVarian;

/**
 * @group POS TRANSACTION
 */
class ReportController extends Controller
{
    protected $saleOrderContract;

    protected $transactionContract;

    protected $saleOrderDetailContract;

    protected $transactionDetailContract;

    protected $saleIncludeTransformer;

    protected $uuid = 'sale_uuid';

    public function __construct(TransactionContract $transactionContract,SaleOrderDetailContract $saleOrderDetailContract,SaleOrderContract $saleOrderContract, TransactionDetailContract $transactionDetailContract, SaleIncludeTransformer $saleIncludeTransformer)
    {
        parent::__construct();

        $this->saleOrderContract = $saleOrderContract;

        $this->saleOrderDetailContract = $saleOrderDetailContract;

        $this->transactionDetailContract = $transactionDetailContract;

        $this->saleIncludeTransformer = $saleIncludeTransformer;

        $this->transactionContract = $transactionContract;
    }

   

    public function getreport(EmployeeContract $employeeContract)
    {
        $user = \Auth::user();
       
    
        $outlet= Outlet::where('out_comp_id',$user->value_id)->get();
        foreach($outlet as $key=>$a){
             $out_id[]=$a->out_id;

        }
        try {
       
            $data = Sale::with(['items','items.varian','employee'])->whereIn('sale_outlet_id', $out_id)->paginate();

            if(!$data) {
                return $this->notFoundResponse("Transaction with id {$uuid} doesn't exist");
            }
       
            return $this->withCollectionResponse($data, $this->saleIncludeTransformer);
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            // dd($e);
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
      

       
    
    }

    public function getrkasir(EmployeeContract $employeeContract)
    {
        $user = \Auth::user();
        $outlet= Outlet::where('out_comp_id',$user->value_id)->get();
        foreach($outlet as $key=>$a){
             $out_id[]=$a->out_id;

        }
        // $sale = Sale::with(['items','items.varian'])->where('sale_outlet_id',$employee->emp_out_id)->get();
        try {
            // $data = $this->saleOrderContract->with(['items','items.varian'])->findBy('sale_outlet_id', $employee->emp_out_id)->get();
            $data = Employee::with('outlet')->whereIn('emp_out_id',  $out_id)->where('emp_type','c')->paginate();

            if(!$data) {
                return $this->notFoundResponse("Not Found");
            }
            return response()->json([
                'data' => $data,

            ],200);
      
            return $this->withCollectionResponse($data, $this->saleIncludeTransformer);
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            // dd($e);
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
      

       
    
    }

    public function filter(Request $request)
    {
        
        $user = \Auth::user();
        $outlet= Outlet::where('out_comp_id',$user->value_id)->get();
        foreach($outlet as $key=>$a){
             $out_id[]=$a->out_id;
        }
        try {
       
          
           $data = Sale::with(['items','items.varian','employee'])
           ->whereBetween('sale_date', array($request->start_date, $request->end_date))
           ->where( function ($query) use($request,$out_id) {
            //    dd($request);
            if(!empty($request->outlet) && !empty($request->cashier)){
                $query->where([
                    ['sale_outlet_id',$request->outlet],
                    ['sale_user_id', $request->cashier],
                ]);

             }
            elseif(!empty($request->outlet)){
               $query->where('sale_outlet_id',$request->outlet);
             }
             elseif(!empty($request->cashier)){
                $query->where('sale_user_id',$request->cashier);
              }else{
                $query->whereIn('sale_outlet_id', $out_id);
             }
           })
           ->paginate();
           
           

            if(!$data) {
                return $this->notFoundResponse("Transaction with id {$uuid} doesn't exist");
            }
       
            return $this->withCollectionResponse($data, $this->saleIncludeTransformer);
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            // dd($e);
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
           
    
    }

    public function show($uuid){
        try {     
            $data = Sale::with(['items','items.varian','employee'])->where('sale_uuid', $uuid)->paginate();
            if(!$data) {
                return $this->notFoundResponse("Transaction with id {$uuid} doesn't exist");
            }
            return $this->withCollectionResponse($data, $this->saleIncludeTransformer);
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

}