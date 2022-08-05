<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use App\Contracts\BaseContract;

abstract class BaseRepository implements BaseContract
{
    protected $model;

    protected $with = [];

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all($columns = array('*'))
    {
        return $this->model->get($columns);
    }

    public function get($columns = array('*'))
    {
        if($this->with) {
            return $this->model->with($this->with)->get($columns);
        }

        return $this->model->get($columns);
    }

    public function with($relations)
    {
        $this->with = is_string($relations) ? func_get_args() : $relations;

        return $this;
    }

    public function paginate($page = 1, $columns = array('*'))
    {
        return $this->model->paginate($this->model->getPerPage(), $columns);
    }

    public function find($id)
    {
        if($this->with) {
            return $this->model->with($this->with)->find($id);
        }

        return $this->model->find($id);
    }

    public function findBy($field, $value, $columns = array('*'))
    {
        if ($this->with) {
            return $this->model->with($this->with)->where($field, $value);
        }

        return $this->model->where($field, '=', $value);
    }

    public function findWhere(array $where)
    {
        return $this->model->where($where);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->model->find($id)->update($data);
    }

    public function updateBy($field, $value, array $data)
    {
        $update = $this->model->where($field, $value)->first();

        return $update->update($data);
    }

    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }

    public function deleteBy($field, $value)
    {
        return $this->model->where($field, '=', $value)->delete();
    }

    public function getRelations()
    {
        return $this->with;
    }

    public function count()
    {
        return $this->model->count();
    }

    public function sumAll($field)
    {
        // return $this->model->groupBy('sale_outlet_id')->sum($field);
        return $this->model->groupBy('sale_outlet_id')->select('sale_outlet_id')->selectRaw('sum('.$field.') as sum');
    }
}
