<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleRequest;
use App\Services\SaleService;
use Illuminate\Http\JsonResponse;

/**
 *
 */
class SaleController extends Controller
{
    /**
     * @var SaleService
     */
    private SaleService $saleService;

    /**
     * @param SaleService $saleService
     */
    public function __construct(SaleService $saleService)
    {
        $this->saleService = $saleService;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json($this->saleService->allSales());
    }

    /**
     * @param SaleRequest $request
     * @return JsonResponse
     */
    public function store(SaleRequest $request): JsonResponse
    {
        return response()->json($this->saleService->createSale($request->all()));
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        return response()->json($this->saleService->showSale($id));
    }

    /**
     * @param SaleRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(SaleRequest $request, $id): JsonResponse
    {
        return response()->json($this->saleService->updateSale($request->all(), $id));
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        return response()->json($this->saleService->destroySale($id));
    }
}
