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
    public function index(): JsonResponse
    {
        return response()->json([
            'sales_of_the_day' => $this->reportService->salesOfTheDay()->sales_of_the_day ?? 0,
            'sales_of_the_month' => $this->reportService->salesOfTheMonth()->sales_of_the_month ?? 0,
            'average_sale_in_the_month' => $this->reportService->averageSaleInTheMonth(),
            'top_selling_products' => $this->reportService->topSellingProducts(),
            'least_sold_products' => $this->reportService->leastSoldProducts(),
            'sum_of_day_sales' => $this->reportService->sumOfDaySales()
        ]);
    }
}
