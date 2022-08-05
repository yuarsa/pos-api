<?php

namespace App\Http\Controllers\v1\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Contracts\Master\EmployeeContract;
use App\Contracts\Master\CustomerContract;
use App\Contracts\Master\ProductContract;
use App\Contracts\Master\OutletContract;
use App\Contracts\Transaction\TransactionContract;
use App\Transformer\v1\Dashboard\DashboardTransformer;
use App\Models\Transaction\Sale;
use Carbon\Carbon;

/**
 * @group Receive Order
 */
class DashboardController extends Controller
{
    protected $EmployeeContract;
    protected $CustomerContract;
    protected $DashboardTransformer;
    protected $ProductContract;
    protected $OutletContract;
    protected $TransactionContract;

    public function __construct(
        EmployeeContract $EmployeeContract, 
        CustomerContract $CustomerContract, 
        DashboardTransformer $DashboardTransformer,
        ProductContract $ProductContract,
        OutletContract $OutletContract,
        TransactionContract $TransactionContract
    )
    {
        parent::__construct();

        $this->EmployeeContract = $EmployeeContract;
        $this->CustomerContract = $CustomerContract;
        $this->DashboardTransformer = $DashboardTransformer;
        $this->ProductContract = $ProductContract;
        $this->OutletContract = $OutletContract;
        $this->TransactionContract = $TransactionContract;
    }

    public function index()
    {   
        try {
            $user = \Auth::user();
            $countOutlet = $this->OutletContract->findBy('out_comp_id', $user->value_id)->count();
            $countProduct = $this->ProductContract->findBy('prod_company_id', $user->value_id)->count();
            $countCustomer = $this->CustomerContract->findBy('cus_comp_id', $user->value_id)->count();
            $outlet =  $this->OutletContract->findBy('out_comp_id', $user->value_id)->get();
            $countSale = 0;
            $whereIn = [];
            foreach ($outlet as $item){
                $countSale += $this->TransactionContract->findBy('sale_outlet_id', $item->out_id)->count();
                $whereIn[] = $item->out_id;
            }
            // dd($whereIn);
            // $Allsale = $this->TransactionContract->sumALl('sale_total')->whereIn('sale_outlet_id', $whereIn)->with('outlet')->get();
            // $months = Sale::whereIn('sale_outlet_id', $whereIn)->with('outlet:out_id,out_name')->select('sale_outlet_id','sale_total','created_at')->get()->groupBy(function($d) {
            //     return Carbon::parse($d->created_at)->format('m');
            // });
            $tempOrder;
            foreach ($outlet as $item){
                $orders = Sale::select('sale_outlet_id')->select(
                    DB::raw('sum(sale_total) as sum'),
                    DB::raw("extract(month from created_at) as months")
                )
                ->where('sale_outlet_id',$item->out_id)
                ->groupBy('months')
                ->get();
                if(sizeof($orders) !== 0){
                    $tempOrder[] = [
                        "outlet" => $item->out_name,
                        "data" => $orders
                    ];
                }
            }
            // dd($months);
            // return response()->json($tempOrder);
            $count = [
                // "employee"=>$countEmployee,
                "customer"=>$countCustomer,
                "product"=>$countProduct,
                "outlet"=>$countOutlet,
                "sale"=>$countSale,
            ];
            $sale = [
                "data"=>$tempOrder
            ];
            $data = [
                'count'=>$count, 
                'sale'=>$sale
            ];
            return $this->withItemResponse($data, $this->DashboardTransformer);
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
            $data = $this->receivedOrderContract->find($id)->first();

            if(!$data) {
                return $this->notFoundResponse("Received Order with id {$id} doesn't exist");
            }

            return $this->withItemResponse($data, $this->receivedOrderTransformer);
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

}