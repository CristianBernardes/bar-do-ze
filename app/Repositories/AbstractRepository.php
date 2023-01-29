<?php

namespace App\Repositories;

use App\Contracts\AbstractInterface;

/**
 *
 */
abstract class AbstractRepository implements AbstractInterface
{
    /**
     * @return mixed
     */
    abstract public function model();

    /**
     * @return mixed
     */
    public function index(): mixed
    {
        return $this->model()::all();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data): mixed
    {
        $model = $this->model()::create($data);

        return $model;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id): mixed
    {
        return $this->model()::findOrFail($id);
    }

    /**
     * @param array $data
     * @param int $id
     * @return mixed
     */
    public function update(array $data, int $id): mixed
    {
        $model = $this->model()::findOrFail($id);

        $model->update($data);

        return $model;
    }

    /**
     * @param int $id
     * @return void
     */
    public function destroy(int $id): mixed
    {
        $model = $this->model()::findOrFail($id);

        $model->delete();
    }
}
