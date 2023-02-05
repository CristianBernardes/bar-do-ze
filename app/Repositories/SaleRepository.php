<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\ProductSale;
use App\Models\Sale;

/**
 *
 */
class SaleRepository extends AbstractRepository
{
    /**
     * @return mixed
     */
    public function model()
    {
        return Sale::class;
    }

    /**
     * @return mixed
     */
    public function index($month = null): mixed
    {
        return $this->model()::querySaleMonth();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data): mixed
    {
        $products = $data['products'];

        $saleElements = array_map(function ($a, $b) {
            return ['amount' => $a, 'product' => $b];
        }, array_count_values($products), array_unique($products));

        $sale = $this->model()::create($data);

        foreach ($saleElements as $saleElement) {

            $product = Product::select('price')->where('id', $saleElement['product'])->first();

            ProductSale::create([
                'sale_id' => $sale->id,
                'product_id' => $saleElement['product'],
                'price' => $product->price,
                'amount' => $saleElement['amount']
            ]);
        }

        return $sale;
    }
}
