<?php

namespace App\Http\Controllers\v1\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Contracts\Transaction\PurchaseOrderContract;
use App\Contracts\Transaction\PurchaseOrderDetailContract;
use App\Transformer\v1\Transaction\PurchaseOrderTransformer;

/**
 * @group Purchase Order
 */
class PurchaseOrderController extends Controller
{
    protected $purchaseOrderContract;

    protected $purchaseOrderDetailContract;

    protected $purchaseOrderTransformer;

    protected $uuid = 'po_uuid';

    public function __construct(PurchaseOrderContract $purchaseOrderContract, PurchaseOrderDetailContract $purchaseOrderDetailContract, PurchaseOrderTransformer $purchaseOrderTransformer)
    {
        parent::__construct();

        $this->purchaseOrderContract = $purchaseOrderContract;

        $this->purchaseOrderDetailContract = $purchaseOrderDetailContract;

        $this->purchaseOrderTransformer = $purchaseOrderTransformer;
    }

    public function index()
    {
        try {
            $data = $this->purchaseOrderContract->paginate();

            if($data->isEmpty()) {
                return $this->emptyResponse();
            } else {
                return $this->withCollectionResponse($data, $this->purchaseOrderTransformer);
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
            $data = $this->purchaseOrderContract->findBy($this->uuid, $uuid)->first();

            if(!$data) {
                return $this->notFoundResponse("Purchase Order with id {$uuid} doesn't exist");
            }

            return $this->withItemResponse($data, $this->purchaseOrderTransformer);
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

            if($user->type == 'c') {
                $request['po_company_id'] = $user->value_id;
            } else {
                $request['po_company_id'] = $request->po_company_id;
            }

            if($user->type == 'o') {
                $request['po_outlet_id'] = $user->value_id;
            } else {
                $request['po_outlet_id'] = $request->po_outlet_id;
            }

            $request['po_code'] = $this->generateTransactionCode($request);

            $header = $this->purchaseOrderContract->create($request->all());

            if($header) {
                $po_id = $header->po_id;

                $items = $request->items;

                if($items) {
                    foreach ($items as $value) {
                        $insert = [
                            'pod_po_id' => $po_id,
                            'pod_product_id' => $value['pod_product_id'],
                            'pod_description' => $value['pod_description'],
                            'pod_qty' => $value['pod_qty'],
                            'pod_price' => $value['pod_price'],
                            'pod_tax' => $value['pod_tax'],
                            'pod_total' => $value['pod_total'],
                        ];

                        $this->purchaseOrderDetailContract->create($insert);
                    }

                    DB::commit();

                    return $this->withCustomResponse(201, 'Created data transaction succesfully with id: '.$header->po_uuid);
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

            $purchase = $this->purchaseOrderContract->findBy($this->uuid, $uuid)->first();

            if(!$purchase) {
                return $this->notFoundResponse("Purchase order with id {$uuid} doesn't exist");
            }

            if($user->type == 'o') {
                $request['po_outlet_id'] = $user->value_id;
            } else {
                $request['po_outlet_id'] = $request->po_outlet_id;
            }

            $header = $this->purchaseOrderContract->updateBy($this->uuid, $uuid, $request->all());

            if($header) {
                $this->purchaseOrderContract->delete($purchase->po_id);

                $items = $request->items;

                if($items) {
                    foreach ($items as $value) {
                        $insert = [
                            'pod_po_id' => $purchase->po_id,
                            'pod_product_id' => $value['pod_product_id'],
                            'pod_description' => $value['pod_description'],
                            'pod_qty' => $value['pod_qty'],
                            'pod_price' => $value['pod_price'],
                            'pod_tax' => $value['pod_tax'],
                            'pod_total' => $value['pod_total'],
                        ];

                        $this->purchaseOrderDetailContract->create($insert);
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
            $data = $this->purchaseOrderContract->findBy($this->uuid, $uuid)->first();

            if(!$data) {
                return $this->notFoundResponse("Purchase order with id {$uuid} doesn't exist");
            }

            if($data->po_status == 3) {
                return $this->notFoundResponse("Purchase order can't be deleted, because it has been completed");
            } else {
                $this->purchaseOrderContract->deleteBy($this->uuid, $uuid);

                $this->purchaseOrderDetailContract->deleteBy('pod_po_id', $data->po_id);

                return $this->withCustomResponse(200, "Delete data succesfully with purchase order id: {$uuid}");
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
            $data = $this->purchaseOrderContract->findBy($this->uuid, $uuid)->first();

            if(!$data) {
                return $this->notFoundResponse("Purchase order with id {$uuid} doesn't exist");
            }

            $this->purchaseOrderContract->updateBy($this->uuid, $uuid, $request->only('po_status'));

            return $this->withCustomResponse(201, 'Set status purchase order succesfully');
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

            $po = $this->purchaseOrderContract->get(['po_id', 'po_uuid', 'po_code']);

            $data = [];
            foreach ($po as $value) {
                $data[] = [
                    'id' => $value->po_id,
                    'uuid' => $value->po_uuid,
                    'name' => 'PO/'. $value->po_code
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

    private function generateTransactionCode($request)
    {
        $romawi = ["", "I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII"];

        $company_id = $request->po_company_id;

        $outlet_id = $request->po_outlet_id;

        $max = $this->purchaseOrderContract->findWhere(['po_company_id' => $company_id, 'po_outlet_id' => $outlet_id])->max('po_code');

        if($max) {
            $max_code = substr($max, 0, 7);

            $nomor = sprintf('%07s', intval($max_code) + 1);

            $code = $nomor.'/PO.'.$company_id.$outlet_id.'/'.$romawi[date('n')].'/'.date('Y');
        } else {
            $code = '0000001/PO.'.$company_id.$outlet_id.'/'.$romawi[date('n')].'/'.date('Y');
        }

        return $code;
    }
}