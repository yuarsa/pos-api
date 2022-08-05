<?php

namespace App\Http\Controllers\v1\Transaction;

use App\Contracts\Master\OutletContract;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Contracts\Transaction\SaleOrderContract;
use App\Contracts\Transaction\SaleOrderDetailContract;
use App\Transformer\v1\Transaction\SaleOrderTransformer;
use App\Models\Transaction\Sale;

/**
 * @group Sale Order
 */
class SaleOrderController extends Controller
{
    protected $saleOrderContract;

    protected $saleOrderDetailContract;

    protected $saleOrderTransformer;

    protected $outletContract;

    protected $uuid = 'sale_uuid';

    public function __construct(SaleOrderContract $saleOrderContract, SaleOrderDetailContract $saleOrderDetailContract, SaleOrderTransformer $saleOrderTransformer, OutletContract $outletContract)
    {
        parent::__construct();

        $this->saleOrderContract = $saleOrderContract;

        $this->saleOrderDetailContract = $saleOrderDetailContract;

        $this->saleOrderTransformer = $saleOrderTransformer;

        $this->outletContract = $outletContract;
    }

    public function index()
    {
        try {
            $user = \Auth::user();

            if($user->type == 'c' || $user->type == 'm') {
                $outlet = $this->outletContract->findBy('out_comp_id', $user->value_id)->get();

                if(!$outlet) {
                    return $this->notFoundResponse("Outlet id doesn't exists");
                }

                foreach ($outlet as $key => $value) {
                    $outlet_id[] = $value->out_id;
                }

                // $data = $this->saleOrderContract->findBy('sale_outlet_id', $outlet->out_id)->paginate();
                $data = Sale::whereIn('sale_outlet_id', $outlet_id)->paginate();
            } else if($user->type == 'o') {
                $data = $this->saleOrderContract->findBy('sale_outlet_id', $user->value_id)->paginate();
            } else {
                $data = [];
            }

            if($data->isEmpty()) {
                return $this->emptyResponse();
            } else {
                return $this->withCollectionResponse($data, $this->saleOrderTransformer);
            }
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    public function show($uuid)
    {
        try {
            $data = $this->saleOrderContract->findBy($this->uuid, $uuid)->first();

            if(!$data) {
                return $this->notFoundResponse("Sale Order with id {$uuid} doesn't exist");
            }

            return $this->withItemResponse($data, $this->saleOrderTransformer);
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
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = \Auth::user();

            if($user->type == 'o') {
                $request['sale_outlet_id'] = $user->value_id;
            } else {
                $request['sale_outlet_id'] = $request->sale_outlet_id;
            }

            $request['sale_code'] = $this->generateTransactionCode().date('His');

            $request['sale_cashier'] = 'Admin';

            $request['sale_user_id'] = $user->id;

            $header = $this->saleOrderContract->create($request->all());

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
                        ];

                        $this->saleOrderDetailContract->create($insert);
                    }

                    DB::commit();

                    return $this->withCustomResponse(201, 'Created data transaction succesfully with id: '.$header->sale_uuid);
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

    public function update(Request $request, $uuid)
    {
        DB::beginTransaction();
        try {
            $user = \Auth::user();

            $sales = $this->saleOrderContract->findBy($this->uuid, $uuid)->first();

            if(!$sales) {
                return $this->notFoundResponse("Sale order with id {$uuid} doesn't exist");
            }

            if($user->type == 'o') {
                $request['sale_outlet_id'] = $user->value_id;
            } else {
                $request['sale_outlet_id'] = $request->sale_outlet_id;
            }

            $header = $this->saleOrderContract->updateBy($this->uuid, $uuid, $request->all());

            if($header) {
                $this->saleOrderContract->delete($sales->sale_id);

                $items = $request->items;

                if($items) {
                    foreach ($items as $value) {
                        $insert = [
                            'saledet_sale_id' => $sales->sale_id,
                            'saledet_product_id' => $value['saledet_product_id'],
                            'saledet_qty' => $value['saledet_qty'],
                            'saledet_price' => $value['saledet_price'],
                            'saledet_total' => $value['saledet_total'],
                            'saledet_discount_percent' => $value['saledet_discount_percent'],
                            'saledet_discount' => $value['saledet_discount'],
                            'saledet_tax_id' => $value['saledet_tax_id'],
                            'saledet_tax' => $value['saledet_tax'],
                            'saledet_grand_total' => $value['saledet_grand_total'],
                        ];

                        $this->saleOrderDetailContract->create($insert);
                    }

                    DB::commit();

                    return $this->withCustomResponse(201, 'Updated data transaction succesfully with id: '.$uuid);
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

    public function destroy($uuid)
    {
        try {
            $data = $this->saleOrderContract->findBy($this->uuid, $uuid)->first();

            if(!$data) {
                return $this->notFoundResponse("Sale order with id {$uuid} doesn't exist");
            }

            if($data->sale_status == 3) {
                return $this->notFoundResponse("Sale order can't be deleted, because it has been completed");
            } else {
                $this->saleOrderContract->deleteBy($this->uuid, $uuid);

                $this->saleOrderDetailContract->deleteBy('saledet_sale_id', $data->sale_id);

                return $this->withCustomResponse(200, "Delete data succesfully with sale order id: {$uuid}");
            }
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    public function setStatus(Request $request, $uuid)
    {
        try {
            $data = $this->saleOrderContract->findBy($this->uuid, $uuid)->first();

            if(!$data) {
                return $this->notFoundResponse("Sale order with id {$uuid} doesn't exist");
            }

            $this->saleOrderContract->updateBy($this->uuid, $uuid, $request->only('sale_status'));

            return $this->withCustomResponse(201, 'Set status sale order succesfully');
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    private function generateTransactionCode($length = 7)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $charactersLength = strlen($characters);

        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}
