<?php

namespace App\Contracts;

interface BaseContract
{
    public function all($columns = array('*'));

    public function get($columns = array('*'));

    public function with($relations);

    public function paginate($page = 1, $columns = array('*'));

    public function find($id);

    public function findBy($field, $value, $columns = array('*'));

    public function findWhere(array $where);

    public function create(array $data);

    public function update(array $data, $id);

    public function updateBy($field, $value, array $data);

    public function delete($id);

    public function deleteBy($field, $value);

    public function count();

    public function sumAll($field);
}