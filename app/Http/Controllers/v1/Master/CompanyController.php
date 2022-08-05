<?php

namespace App\Http\Controllers\v1\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\Company;
use DB;

/**
 * @group Masters
 */
class CompanyController extends Controller
{

    public function __construct() {
    }

    public function index($id){
        $data = DB::table('mst_companies')
                ->join('ref_provinces','mst_companies.comp_prov_code','ref_provinces.prov_code')
                ->join('ref_regencies','mst_companies.comp_reg_code','ref_regencies.reg_code')
                ->where('comp_id',$id)->first();
        return response()->json([
            "data" => $data
        ],200);
    }

    /**
     * @queryParam cus_uuid required Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa
     */
    public function show($id)
    {
        try {
            $data = Company::find($id);
            return response()->json([
                "data" => $data,
                "status" => 200
            ],200);
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    public function store(CustomerRequest $request)
    {
        // try {
        //     $request['cus_comp_id'] = \Auth::user()->value_id;

        //     $request['cus_code'] = '0001';

        //     $customer = $this->customerContract->create($request->all());

        //     return $this->withCustomResponse(201, 'Created data succesfully with customer code: '.$customer->cus_code);
        // } catch (QueryException $qe) {
        //     return $this->withCustomErrorResponse(422, $qe->getMessage());
        // } catch (ModelNotFoundException $mnfe) {
        //     return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        // } catch (\Exception $e) {
        //     return $this->withCustomErrorResponse(500, $e->getMessage());
        // }
    }

    public function update($id, Request $request)
    {
        try {
            $update = Company::where('comp_id',$id)->update($request->json()->all());
            return response()->json([
                "status"=> true,
                "message"=> "update data success"
            ],200);
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    /**
     * @queryParam cus_uuid required Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa
     */
    public function destroy($uuid)
    {
        try {
            return $this->withCustomResponse(200, "Delete data succesfully with customer id: {$uuid}");
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

}
