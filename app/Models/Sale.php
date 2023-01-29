<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sale extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'identify',
        'payment_method',
        'date',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['sale_items'];

    /**
     * @return string|null
     */
    public function getSaleItemsAttribute()
    {
        return ProductSale::select(
            'products.name',
            'product_sales.price',
            'product_sales.amount',
            DB::raw('(product_sales.price * product_sales.amount) AS sale_value')
        )
            ->join('products', 'products.id', 'product_sales.product_id')
            ->where('product_sales.sale_id', $this->id)
            ->get();
    }
}
