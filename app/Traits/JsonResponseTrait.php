<?php

namespace App\Traits;

use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response;

trait JsonResponseTrait
{
    protected $status = 200;

    protected $fractal;

    public function setFractal(Manager $fractal)
    {
        $this->fractal = $fractal;

        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatusCode($status)
    {
        $this->status = $status;

        return $this;
    }

    public function withCustomResponse($status, $message, $data = '')
    {
        return response()->json(['status' => $status, 'message' => $message, 'data' => $data], $status);
    }

    public function withCustomErrorResponse($status, $message)
    {
        return response()->json(['error' => ['status' => $status, 'message' => $message]], $status);
    }

    public function withArrayResponse(array $data, array $header = [])
    {
        return response()->json(['status' => $this->status, 'message' => 'Data found', 'data' => $data], $this->status, $header);
    }

    public function withItemResponse($item, $callback)
    {
        $items = new Item($item, $callback);

        $create = $this->fractal->createData($items);

        return $this->withArrayResponse($create->toArray());
    }

    public function withCollectionResponse($collection, $transformer)
    {
        $data = new Collection($collection, $transformer);

        if(empty($collection)) {
            $collection = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 10);

            $data = new Collection($collection, $transformer);
        }

        $data->setPaginator(new IlluminatePaginatorAdapter($collection));

        $response = $this->fractal->createData($data);

        return $this->withArrayResponse($response->toArray());
    }

    public function withCollectionWithoutPaginationResponse($collection, $transformer)
    {
        $data = new Collection($collection, $transformer);

        // if(empty($collection)) {
        //     $collection = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 10);

        //     $data = new Collection($collection, $transformer);
        // }

        // $data->setPaginator(new IlluminatePaginatorAdapter($collection));

        $response = $this->fractal->createData($data);

        return $this->withArrayResponse($response->toArray());
    }

    public function forbiddenResponse($message = 'Forbidden response')
    {
        return response()->json(['status' => Response::HTTP_FORBIDDEN, 'message' => $message], Response::HTTP_FORBIDDEN);
    }

    public function emptyResponse()
    {
        $result = new \stdClass();

        return response()->json(['status' => Response::HTTP_NO_CONTENT, 'message' => 'No Content', 'data' => $result]);
    }

    public function notFoundResponse($message = '')
    {
        if($message == '') {
            $message = 'Response was not found';
        }

        return response()->json(['status' => Response::HTTP_NOT_FOUND, 'message' => $message], Response::HTTP_NOT_FOUND);
    }

    public function errorFieldResponse($type, $error)
    {
        if($type == 'unknown') {
            return response()->json(['status' => 400, 'unknown' => $error], 400);
        }

        if($type == 'invalid') {
            return response()->json(['status' => 400, 'invalid' => $error], 400);
        }

        if($type == 'invalid_filter') {
            return response()->json(['status' => 400, 'invalid_filter' => $error], 400);
        }
    }
}
