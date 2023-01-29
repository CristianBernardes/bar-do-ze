<?php

namespace App\Services;

use App\Repositories\SaleRepository;

/**
 *
 */
class SaleService
{
    /**
     * @var SaleRepository
     */
    private SaleRepository $saleRepository;

    /**
     * @param SaleRepository $saleRepository
     */
    public function __construct(SaleRepository $saleRepository)
    {
        $this->saleRepository = $saleRepository;
    }

    /**
     * @return mixed
     */
    public function allSales(): mixed
    {
        return $this->saleRepository->index();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function createSale(array $data): mixed
    {
        return $this->saleRepository->store($data);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function showSale(int $id): mixed
    {
        return $this->saleRepository->show($id);
    }

    /**
     * @param array $data
     * @param int $id
     * @return mixed
     */
    public function updateSale(array $data, int $id): mixed
    {
        return $this->saleRepository->update($data, $id);
    }

    /**
     * @param int $id
     * @return mixed|null
     */
    public function destroySale(int $id): mixed
    {
        return $this->saleRepository->destroy($id);
    }
}
