<?php

namespace App\Http\Controllers\v1\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Contracts\Transaction\ReceivedOrderContract;
use App\Contracts\Transaction\ReceivedOrderDetailContract;
use App\Transformer\v1\Transaction\ReceivedOrderTransformer;

/**
 * @group Receive Order
 */
class ReceivedOrderController extends Controller
{
    protected $receivedOrderContract;

    protected $receivedOrderDetailContract;

    protected $receivedOrderTransformer;

    public function __construct(ReceivedOrderContract $receivedOrderContract, ReceivedOrderDetailContract $receivedOrderDetailContract, ReceivedOrderTransformer $receivedOrderTransformer)
    {
        parent::__construct();

        $this->receivedOrderContract = $receivedOrderContract;

        $this->receivedOrderDetailContract = $receivedOrderDetailContract;

        $this->receivedOrderTransformer = $receivedOrderTransformer;
    }

    public function index()
    {
        try {
            $data = $this->receivedOrderContract->paginate();

            if($data->isEmpty()) {
                return $this->emptyResponse();
            } else {
                return $this->withCollectionResponse($data, $this->receivedOrderTransformer);
            }
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
            $request['rcv_code'] = $this->generateTransactionCode($request);

            $header = $this->receivedOrderContract->create($request->except('items'));

            if($header) {
                $id = $header->rcv_id;

                $items = $request->items;

                if($items) {
                    foreach ($items as $value) {
                        $insert = [
                            'rcvd_rcv_id' => $id,
                            'rcvd_product_id' => $value['rcvd_product_id'],
                            'rcvd_qty' => $value['rcvd_qty'],
                        ];

                        $this->receivedOrderDetailContract->create($insert);
                    }

                    DB::commit();

                    return $this->withCustomResponse(201, 'Created data transaction succesfully with id: '.$header->rcv_id);
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

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = $this->receivedOrderContract->find($id);

            if(!$data) {
                return $this->notFoundResponse("Received order with id {$id} doesn't exist");
            }

            $header = $this->receivedOrderContract->update($request->except('items'), $id);

            if($header) {
                $this->receivedOrderContract->delete($data->rcv_id);

                $items = $request->items;

                if($items) {
                    foreach ($items as $value) {
                        $insert = [
                            'rcvd_rcv_id' => $id,
                            'rcvd_product_id' => $value['rcvd_product_id'],
                            'rcvd_qty' => $value['rcvd_qty'],
                        ];

                        $this->receivedOrderDetailContract->create($insert);
                    }

                    DB::commit();

                    return $this->withCustomResponse(201, 'Updated data transaction succesfully with id: '.$id);
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

    private function generateTransactionCode($request)
    {
        $romawi = ["", "I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII"];

        $max = $this->receivedOrderContract->findBy('rcv_po_id', $request->rcv_po_id)->max('rcv_code');

        if($max) {
            $max_code = substr($max, 0, 7);

            $nomor = sprintf('%07s', intval($max_code) + 1);

            $code = $nomor.'/RCV.'.$request->rcv_po_id.'/'.$romawi[date('n')].'/'.date('Y');
        } else {
            $code = '0000001/RCV.'.$request->rcv_po_id.'/'.$romawi[date('n')].'/'.date('Y');
        }

        return $code;
    }
}