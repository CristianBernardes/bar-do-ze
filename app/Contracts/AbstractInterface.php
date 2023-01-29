<?php

namespace App\Contracts;

/**
 *
 */
interface AbstractInterface
{
    /**
     * @return mixed
     */
    public function index(): mixed;

    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data): mixed;

    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id): mixed;

    /**
     * @param array $data
     * @param int $id
     * @return mixed
     */
    public function update(array $data, int $id): mixed;

    /**
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id): mixed;
}
