<?php

namespace App\Repositories;

use App\Models\Product;

/**
 *
 */
class ProductRepository extends AbstractRepository
{
    /**
     * @return mixed
     */
    public function model()
    {
        return Product::class;
    }
}
