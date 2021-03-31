<?php

namespace App\Repositories;

use App\Cliente;

class ClienteRepository implements InterfazRepository
{

    protected $model;

    /**
     * ClienteRepository constructor.
     *
     * @param Cliente $Cliente
     */
    public function __construct(Cliente $Cliente)
    {
        $this->model = $Cliente;
    }

    public function all()
    {
        return $this->model->get(['*']);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->model->where('id', $id)
            ->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function find($id)
    {
        $Cliente = $this->model->find($id);
        return $Cliente;
    }
}
