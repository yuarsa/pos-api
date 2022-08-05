<?php

namespace App\Http\Controllers\v1\Pos;

use Illuminate\Http\Request;
use App\Http\Requests\v1\Transaction\SaleRequest as SaleRequest;
use App\Http\Requests\v1\Transaction\SaleDetailRequest as SaleDetailRequest;
use App\Http\Controllers\Controller;
use App\Contracts\Transaction\TransactionContract;
use App\Contracts\Transaction\TransactionDetailContract;
use DB;
use App\Transformer\v1\Pos\SaleIncludeTransformer;
use App\Models\Master\KasirModal;
use Illuminate\Support\Carbon;

/**
 * @group POS TRANSACTION
 */
class TransactionController extends Controller
{
    protected $transactionContract;

    protected $transactionDetailContract;

    protected $saleIncludeTransformer;

    protected $uuid = 'sale_uuid';

    public function __construct(TransactionContract $transactionContract, TransactionDetailContract $transactionDetailContract, SaleIncludeTransformer $saleIncludeTransformer)
    {
        parent::__construct();

        $this->transactionContract = $transactionContract;

        $this->transactionDetailContract = $transactionDetailContract;

        $this->saleIncludeTransformer = $saleIncludeTransformer;
    }

    public function checkout(Request $request)
    {
        DB::beginTransaction();
        try {
            $request['sale_code'] = $this->generateTransactionCode().date('His');

            $header = $this->transactionContract->create($request->except('items'));

            if($header) {
                $sale_id = $header->sale_id;

                $items = $request->items;

                if($items) {
                    foreach ($items as $value) {
                        $insert = [
                            'saledet_sale_id' => $sale_id,
                            'saledet_product_id' => $value['saledet_product_id'],
                            'saledet_qty' => $value['saledet_qty'],
                            'saledet_price' => $value['saledet_price'],
                            'saledet_total' => $value['saledet_total'],
                            'saledet_discount_percent' => $value['saledet_discount_percent'],
                            'saledet_discount' => $value['saledet_discount'],
                            'saledet_tax_id' => $value['saledet_tax_id'],
                            'saledet_tax' => $value['saledet_tax'],
                            'saledet_grand_total' => $value['saledet_grand_total'],
                            'saledet_prodvar_id' => $value['saledet_prodvar_id'],
                        ];

                        $this->transactionDetailContract->create($insert);
                    }

                    DB::commit();

                    return $this->withCustomResponse(201, 'Created data transaction succesfully with id: '.$header->sale_uuid, $header->sale_uuid);
                    // return $this->withItemResponse($header, $this->saleIncludeTransformer);
                }
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

    public function getCheckout($uuid)
    {
        try {
            $data = $this->transactionContract->findBy($this->uuid, $uuid)->first();

            if(!$data) {
                return $this->notFoundResponse("Transaction with id {$uuid} doesn't exist");
            }

            return $this->withItemResponse($data, $this->saleIncludeTransformer);
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            // dd($e);
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    public function payment(Request $request, $uuid)
    {
        try {
            $data = $this->transactionContract->findBy($this->uuid, $uuid) ->first();

            if(!$data) {
                return $this->notFoundResponse("Transaction with id {$uuid} doesn't exist");
            }
            
            $this->transactionContract->updateBy($this->uuid, $uuid, $request->all());

            return $this->withCustomResponse(200, "Updated data succesfully with transaction id: {$uuid}");
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    public function generateTransactionCode($length = 7)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $charactersLength = strlen($characters);

        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function modal(Request $request) {
        try {
            $check = KasirModal::where('emp_id',$request->emp_id)
                    ->whereDate('created_at', '=', Carbon::now()->toDateTimeString())->first();
            if($check){
                return response()->json([
                    "data" => null,
                    "message" => "cannot created data",
                    "status" => false
                ],200);
            }else{
                $data = KasirModal::create($request->all());
                return response()->json([
                    "data" => $data->saldo,
                    "message" => "",
                    "status" => 200
                ], 200);
            }
        }catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    public function getModal($uuid){
        try {
            $data = KasirModal::with(['company','outlet','employee'])
            ->where('emp_id',$uuid)
            ->orderBy('created_at','desc')
            ->whereDate('created_at', '=', Carbon::now()->toDateTimeString())->first();
            return response()->json([
                "data" => !empty($data->saldo) ? $data->saldo : 0,
                "message" => "",
                "status" => 200
            ], 200);
        }catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

}