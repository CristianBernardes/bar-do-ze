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
    protected $appends = ['total_sale', 'sale_items'];

    public function getSaleItemsAttribute()
    {
        return $this->querySales($this->id)->get();
    }

    public function getTotalSaleAttribute()
    {
        $subquerySql = $this->querySales($this->id)->toSql();

        return DB::table(DB::raw("($subquerySql) as subquery"))
            ->mergeBindings($this->querySales($this->id)->getQuery())
            ->sum("subquery.sale_value");
    }

    public static function querySaleMonth(int $month = null)
    {
        return self::whereIn('date', $month ?? daysOfTheMonth())->orderBy('id', 'DESC')->get();
    }

    public function querySales($id)
    {
        return ProductSale::select(
            'products.name',
            'product_sales.price',
            'product_sales.amount',
            DB::raw('(product_sales.price * product_sales.amount) AS sale_value')
        )
            ->join('products', 'products.id', 'product_sales.product_id')
            ->where('product_sales.sale_id', $id);
    }
}
