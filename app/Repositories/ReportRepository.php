<?php

namespace App\Repositories;

use App\Models\Reports;

/**
 *
 */
class ReportRepository
{
    /**
     * @return mixed
     */
    public function model()
    {
        return Reports::class;
    }

    /**
     * @return mixed
     */
    public function topSellingProducts(): mixed
    {
        return $this->model()::topSellingProducts();
    }

    /**
     * @return mixed
     */
    public function leastSoldProducts(): mixed
    {
        return $this->model()::leastSoldProducts();
    }

    /**
     * @return mixed
     */
    public function averageSale(): mixed
    {
        return $this->model()::averageSale();
    }

    /**
     * @return mixed
     */
    public function sumOfDaySales(): mixed
    {
        return $this->model()::sumOfDaySales();
    }
}
