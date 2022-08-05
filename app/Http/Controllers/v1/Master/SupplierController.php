<?php

namespace App\Http\Controllers\v1\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Master\SupplierRequest as SupplierRequest;
use App\Contracts\Master\SupplierContract;
use App\Transformer\v1\Master\SupplierTransformer;

/**
 * @group Masters
 */
class SupplierController extends Controller
{
    protected $supplierContract;

    protected $supplierTransformer;
    
    private $uuid = 'sup_uuid';

    public function __construct(SupplierContract $supplierContract, SupplierTransformer $supplierTransformer)
    {
        parent::__construct();

        $this->supplierContract = $supplierContract;

        $this->supplierTransformer = $supplierTransformer;
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
        $data = $this->supplierContract->paginate();

        if($data->isEmpty()) {
            return $this->emptyResponse();
        } else {
            return $this->withCollectionResponse($data, $this->supplierTransformer);
        }
    }

    /**
     * @queryParam sup_uuid required UUID Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa
     */
    public function show($uuid)
    {
        try {
            $data = $this->supplierContract->findBy($this->uuid, $uuid)->first();

            if(!$data) {
                return $this->notFoundResponse("Supplier with id {$uuid} doesn't exist");
            }

            return $this->withItemResponse($data, $this->supplierTransformer);
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    /**
     * @bodyParam sup_name string required Deskripsi.
     * @bodyParam sup_birthday date optional Deskripsi.
     * @bodyParam sup_email string optional Deskripsi.
     * @bodyParam sup_phone string required Deskripsi.
     * @bodyParam sup_address string required Deskripsi.
     * @bodyParam sup_prov_code string required Deskripsi.
     * @bodyParam sup_reg_code string required Deskripsi.
     * @bodyParam sup_postal_code string required Deskripsi.
     * @bodyParam sup_contact string optional Deskripsi.
     * @bodyParam sup_contact_phone string optional Deskripsi.
    */
    public function store(SupplierRequest $request)
    {
        try {
            $request['sup_comp_id'] = \Auth::user()->value_id;

            $request['sup_code'] = $this->getMaxCode();

            $data = $this->supplierContract->create($request->all());

            $code = 'SUP'.$data->sup_code.$data->sup_comp_id;

            return $this->withCustomResponse(201, 'Created data succesfully with supplier code: '.$code);
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    /**
     * @queryParam sup_uuid required UUID. Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa
     * @bodyParam sup_name string required Deskripsi.
     * @bodyParam sup_birthday date optional Deskripsi.
     * @bodyParam sup_email string optional Deskripsi.
     * @bodyParam sup_phone string required Deskripsi.
     * @bodyParam sup_address string required Deskripsi.
     * @bodyParam sup_prov_code string required Deskripsi.
     * @bodyParam sup_reg_code string required Deskripsi.
     * @bodyParam sup_postal_code string required Deskripsi.
     * @bodyParam sup_contact string optional Deskripsi.
     * @bodyParam sup_contact_phone string optional Deskripsi.
    */
    public function update(SupplierRequest $request, $uuid)
    {
        try {
            $data = $this->supplierContract->findBy($this->uuid, $uuid) ->first();

            if(!$data) {
                return $this->notFoundResponse("Supplier with id {$uuid} doesn't exist");
            }
            
            $update = $this->supplierContract->updateBy($this->uuid, $uuid, $request->all());

            return $this->withCustomResponse(200, "Updated data succesfully with supplier id: {$uuid}");
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    /**
     * @queryParam sup_uuid required UUID. Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa
     */
    public function destroy($uuid)
    {
        try {
            $data = $this->supplierContract->findBy($this->uuid, $uuid)->first();

            if(!$data) {
                return $this->notFoundResponse("Supplier with id {$uuid} doesn't exist");
            }
            
            $delete = $this->supplierContract->deleteBy($this->uuid, $uuid);

            return $this->withCustomResponse(200, "Delete data succesfully with supplier id: {$uuid}");
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    /**
     * @response 200 {
     *      "status": 200,
     *      "message": "Data found",
     *      "data": {id, name}
     * }
     */
    public function autocomplete()
    {
        try {
            $user = \Auth::user();

            if($user->type == 'c') {
                $supplier = $this->supplierContract->findBy('sup_comp_id', $user->value_id)->select('sup_id', 'sup_code', 'sup_name')->get();
            } else if($user->type == 's') {
                $supplier = $this->supplierContract->get(['sup_id', 'sup_code', 'sup_name']);
            } else {
                $supplier = '';
            }

            $data = [];
            foreach ($supplier as $value) {
                $data[] = [
                    'id' => $value->sup_id,
                    'name' => '['.$value->sup_code .']-'. $value->sup_name
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

    private function getMaxCode()
    {
        $company_id = \Auth::user()->value_id;

        $getMaxCode = $this->supplierContract->findBy('sup_comp_id', $company_id)->max('sup_code');

        $kode = sprintf('%04s', intval($getMaxCode) + 1);

        return $kode;
    }
}
