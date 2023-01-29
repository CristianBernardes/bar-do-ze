<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 *
 */
class Reports extends Model
{
    use HasFactory;

    /**
     * @return mixed
     */
    public static function topSellingProducts(): mixed
    {
        return self::querySellingProducts()
            ->orderBy('amount', 'DESC')
            ->orderBy('products.name', 'asc')
            ->get();
    }

    /**
     * @return mixed
     */
    public static function leastSoldProducts(): mixed
    {
        return self::querySellingProducts()
            ->orderBy('amount', 'ASC')
            ->orderBy('products.name', 'asc')
            ->get();
    }

    /**
     * @return mixed
     */
    public static function averageSale(): mixed
    {
        return ProductSale::select(DB::raw('ROUND(AVG(product_sales.price * product_sales.amount), 2) AS average_sale'))
            ->join('sales', 'product_sales.sale_id', 'sales.id')
            ->whereIn('sales.date', self::daysOfTheMonth())
            ->first();
    }

    /**
     * @return array
     */
    public static function sumOfDaySales(): array
    {
        $dates = [];

        foreach (self::daysOfTheMonth() as $day) {

            $query = ProductSale::select('sales.date', DB::raw('ROUND(SUM(product_sales.price  * product_sales.amount), 2) AS sum_of_sales'))
                ->join('sales', 'product_sales.sale_id', 'sales.id')
                ->where('sales.date', $day)
                ->groupBy('sales.date')
                ->first();

            if ($query) {

                $dates[] = [
                    'date' => $query->date,
                    'sum_of_sales' => $query->sum_of_sales
                ];
            } else {

                $dates[] = [
                    'date' => $day,
                    'sum_of_sales' => 0
                ];
            }
        }

        return $dates;
    }

    /**
     * @return mixed
     */
    protected static function querySellingProducts(): mixed
    {
        return ProductSale::select(
            'products.name AS products_name',
            DB::raw(
                'CONVERT(COALESCE(SUM(product_sales.amount), 0), SIGNED) AS amount'
            )
        )
            ->rightJoin('products', 'product_sales.product_id', 'products.id')
            ->groupBy('products.name')
            ->take(5);
    }

    /**
     * @return array
     */
    protected static function daysOfTheMonth(): array
    {
        $date = Carbon::now();
        $daysInMonth = $date->daysInMonth;

        $days = [];

        for ($i = 1; $i <= $daysInMonth; $i++) {
            $day = Carbon::createFromDate($date->year, $date->month, $i);
            $days[] = $day->format('Y-m-d');
        }

        return $days;
    }
}
