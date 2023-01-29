<?php

namespace App\Http\Controllers;

use App\Helpers\NumericFormatting;
use App\Services\ReportService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

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
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $salesOfTheDay = NumericFormatting::formatBraziliancurrency($this->reportService->salesOfTheDay()->sales_of_the_day ?? 0);
        $salesOfTheMonth = NumericFormatting::formatBraziliancurrency($this->reportService->salesOfTheMonth()->sales_of_the_month ?? 0);
        $averageSaleInTheMonth = NumericFormatting::formatBraziliancurrency($this->reportService->averageSaleInTheMonth());
        $topSellingProducts = $this->reportService->topSellingProducts();
        $leastSoldProducts = $this->reportService->leastSoldProducts();
        $sumOfDaySales = $this->reportService->sumOfDaySales();

        return view(
            'site.dashboard',
            compact(
                'salesOfTheDay',
                'salesOfTheMonth',
                'averageSaleInTheMonth',
                'topSellingProducts',
                'leastSoldProducts',
                'sumOfDaySales'
            )
        );
    }
}
