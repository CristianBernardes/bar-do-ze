<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    /**
     * @var ProductRepository
     */
    private ProductRepository $productRepository;

    /**
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @return mixed
     */
    public function allProducts(): mixed
    {
        return $this->productRepository->index();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function createProduct(array $data): mixed
    {
        return $this->productRepository->store($data);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function showProduct(int $id): mixed
    {
        return $this->productRepository->show($id);
    }

    /**
     * @param array $data
     * @param int $id
     * @return mixed
     */
    public function updateProduct(array $data, int $id): mixed
    {
        return $this->productRepository->update($data, $id);
    }

    /**
     * @param int $id
     * @return mixed|null
     */
    public function destroyProduct(int $id): mixed
    {
        return $this->productRepository->destroy($id);
    }
}
