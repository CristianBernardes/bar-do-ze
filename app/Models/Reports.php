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
    public static function salesOfTheDay(): mixed
    {
        return self::querySalesMonthDay([date('Y-m-d')], 'sales_of_the_day');
    }

    /**
     * @return mixed
     */
    public static function salesOfTheMonth(): mixed
    {
        return self::querySalesMonthDay(self::daysOfTheMonth(), 'sales_of_the_month');
    }

    /**
     * @return float
     */
    public static function averageSaleInTheMonth(): float
    {
        return round(self::salesOfTheMonth()->sales_of_the_month / sizeof(self::daysOfTheMonth()), 2);
    }

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
     * @return array
     */
    public static function sumOfDaySales(): array
    {
        $labels = self::daysOfTheMonth();
        $values = [];

        foreach ($labels as $day) {

            $query = ProductSale::select('sales.date', DB::raw('ROUND(SUM(product_sales.price  * product_sales.amount), 2) AS sum_of_sales'))
                ->join('sales', 'product_sales.sale_id', 'sales.id')
                ->where('sales.date', $day)
                ->groupBy('sales.date')
                ->first();

            if ($query) {

                $values[] = $query->sum_of_sales;
            } else {

                $values[] = 0;
            }
        }

        return [
            'labels' => array_map(function ($date) {
                return "dia " . formatDateAndTime($date, 'd');
            }, $labels),
            'values' => $values
        ];
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
     * @param $dates
     * @param $aliases
     * @return mixed
     */
    protected static function querySalesMonthDay($dates, $aliases): mixed
    {
        return ProductSale::select(DB::raw("ROUND(SUM(product_sales.price * product_sales.amount), 2) AS $aliases"))
            ->join('sales', 'product_sales.sale_id', 'sales.id')->whereIn('sales.date', $dates)->first();
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
