<?php

namespace App\Http\Controllers;

use App\Services\ReportService;
use Illuminate\Http\JsonResponse;

/**
 *
 */
class ReportsController extends Controller
{
    /**
     * @var ReportService
     */
    private ReportService $reportService;

    /**
     * @param ReportService $reportService
     */
    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    /**
     * @return JsonResponse
     */
    public function topSellingProducts(): JsonResponse
    {
        return response()->json($this->reportService->topSellingProducts());
    }

    /**
     * @return JsonResponse
     */
    public function leastSoldProducts(): JsonResponse
    {
        return response()->json($this->reportService->leastSoldProducts());
    }

    /**
     * @return JsonResponse
     */
    public function averageSale(): JsonResponse
    {
        return response()->json($this->reportService->averageSale());
    }

    /**
     * @return JsonResponse
     */
    public function sumOfDaySales(): JsonResponse
    {
        return response()->json($this->reportService->sumOfDaySales());
    }
}
