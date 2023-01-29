<?php

namespace App\Services;

use App\Repositories\ReportRepository;

/**
 *
 */
class ReportService
{
    /**
     * @var ReportRepository
     */
    private ReportRepository $reportRepository;

    /**
     * @param ReportRepository $reportRepository
     */
    public function __construct(ReportRepository $reportRepository)
    {
        $this->reportRepository = $reportRepository;
    }

    /**
     * @return mixed
     */
    public function topSellingProducts(): mixed
    {
        return $this->reportRepository->topSellingProducts();
    }

    /**
     * @return mixed
     */
    public function leastSoldProducts(): mixed
    {
        return $this->reportRepository->leastSoldProducts();
    }

    /**
     * @return mixed
     */
    public function averageSale(): mixed
    {
        return $this->reportRepository->averageSale();
    }

    /**
     * @return mixed
     */
    public function sumOfDaySales(): mixed
    {
        return $this->reportRepository->sumOfDaySales();
    }
}
