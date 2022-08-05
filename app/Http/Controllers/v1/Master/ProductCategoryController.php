<?php

namespace App\Http\Controllers\v1\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Master\ProductCategoryRequest as ProductCategoryRequest;
use App\Contracts\Master\ProductCategoryContract;
use App\Transformer\v1\Master\ProductCategoryTransformer;

/**
 * @group Products
 */
class ProductCategoryController extends Controller
{
    protected $productCategoryContract;

    protected $productCategoryTransformer;

    protected $uuid = 'prodcat_uuid';

    public function __construct(ProductCategoryContract $productCategoryContract, ProductCategoryTransformer $productCategoryTransformer)
    {
        parent::__construct();

        $this->productCategoryContract = $productCategoryContract;

        $this->productCategoryTransformer = $productCategoryTransformer;
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
        $data = $this->productCategoryContract->paginate();

        if($data->isEmpty()) {
            return $this->emptyResponse();
        } else {
            return $this->withCollectionResponse($data, $this->productCategoryTransformer);
        }
    }

    /**
     * @queryParam prodcat_uuid required Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa
     */
    public function show($id)
    {
        try {
            $data = $this->productCategoryContract->findBy($this->uuid, $id)->first();

            if(!$data) {
                return $this->notFoundResponse("Product category with id {$id} doesn't exist");
            }

            return $this->withItemResponse($data, $this->productCategoryTransformer);
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    /**
     * @bodyParam prodcat_outlet_id integer required Deskripsi.
     * @bodyParam prodcat_code string optional Deskripsi.
     * @bodyParam prodcat_name string required Deskripsi.
     * @bodyParam prodcat_description string optional Deskripsi.
     * @bodyParam prodcat_label string optional Deskripsi.
     */
    public function store(ProductCategoryRequest $request)
    {
        try {
            $request['prodcat_company_id'] = \Auth::user()->value_id;

            $data = $this->productCategoryContract->create($request->all());

            return $this->withCustomResponse(201, 'Created data succesfully with id: '.$data->prodcat_uuid);
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    /**
     * @queryParam prodcat_uuid required Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa
     * @bodyParam prodcat_outlet_id integer required Deskripsi.
     * @bodyParam prodcat_code string optional Deskripsi.
     * @bodyParam prodcat_name string required Deskripsi.
     * @bodyParam prodcat_description string optional Deskripsi.
     * @bodyParam prodcat_label string optional Deskripsi.
     */
    public function update(ProductCategoryRequest $request, $id)
    {
        try {
            $data = $this->productCategoryContract->findBy($this->uuid, $id)->first();

            if(!$data) {
                return $this->notFoundResponse("Product Merk with id {$id} doesn't exist");
            }

            $update = $this->productCategoryContract->updateBy($this->uuid, $id, $request->all());

            return $this->withCustomResponse(200, "Updated data succesfully with produk category id: {$id}");
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    /**
     * @queryParam prodcat_uuid required Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa
     */
    public function destroy($id)
    {
        try {
            $data = $this->productCategoryContract->findBy($this->uuid, $id)->first();

            if(!$data) {
                return $this->notFoundResponse("Product category with id {$id} doesn't exist");
            }

            $delete = $this->productCategoryContract->deleteBy($this->uuid, $id);

            return $this->withCustomResponse(200, "Delete data succesfully with product category id: {$id}");
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

            // if($user->type == 'c') {
            //     $category = $this->productCategoryContract->findBy('prodcat_company_id', $user->value_id)->get();
            // } else if($user->type == 'o') {
            //     $category = $this->productCategoryContract->findBy('prodcat_outlet_id', $user->value_id)->get();
            // } else if($user->type == 's') {
            //     $category = $this->productCategoryContract->get();
            // } else {
            //     $category = [];
            // }

            $category = $this->productCategoryContract->get();

            $data = [];
            foreach ($category as $value) {
                $data[] = [
                    'id' => $value->prodcat_id,
                    'uuid' => $value->prodcat_uuid,
                    'name' => $value->prodcat_name,
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

    public function getParentCategory()
    {
        try {
            $category = $this->productCategoryContract->findBy('prodcat_parent_id', 0)->get();

            return $this->withCollectionWithoutPaginationResponse($category, $this->productCategoryTransformer);
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }

    public function getChildrenCategory($id)
    {
        try {
            $category = $this->productCategoryContract->findBy('prodcat_parent_id', $id)->get();

            return $this->withCollectionWithoutPaginationResponse($category, $this->productCategoryTransformer);
        } catch (QueryException $qe) {
            return $this->withCustomErrorResponse(422, $qe->getMessage());
        } catch (ModelNotFoundException $mnfe) {
            return $this->withCustomErrorResponse(422, $mnfe->getMessage());
        } catch (\Exception $e) {
            return $this->withCustomErrorResponse(500, $e->getMessage());
        }
    }
}
