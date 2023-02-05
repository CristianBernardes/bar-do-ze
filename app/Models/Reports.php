<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
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
        return self::querySalesMonthDay(daysOfTheMonth(), 'sales_of_the_month');
    }

    /**
     * @return float
     */
    public static function averageSaleInTheMonth(): float
    {
        return round(self::salesOfTheMonth()->sales_of_the_month / sizeof(daysOfTheMonth()), 2);
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
     * Esta função calcula a soma das vendas realizadas a cada dia de um mês e retorna um array com rótulos
     * e valores.
     *
     * @return array Uma matriz com rótulos e valores da soma das vendas por dia
     */
    public static function sumOfDaySales(): array
    {
        // Obter todas as datas do mês atual
        $dates = daysOfTheMonth();

        // Retorna somente o dia de cada data. Exemplo: 2023-01-10 retorna 10
        $labels = Arr::map($dates, function ($date) {
            return "dia " . Carbon::createFromFormat('Y-m-d', $date)->format('d');
        });

        // Traz os valores de vendas por dia de cada mês
        $values = Arr::map($dates, function ($date) {

            $sumOfSales = ProductSale::select(DB::raw('ROUND(SUM(product_sales.price  * product_sales.amount), 2) AS sum_of_sales'))
                ->join('sales', 'product_sales.sale_id', 'sales.id')
                ->whereDate('sales.date', $date)
                ->groupBy('sales.date')
                ->value('sum_of_sales');

            return $sumOfSales ?? 0;
        });

        // Retorne o array final com rótulos e valores
        return [
            'labels' => $labels,
            'values' => $values
        ];
    }

    /**
     * @return mixed
     */
    protected static function querySellingProducts(): mixed
    {
        return ProductSale::select(
            DB::raw(
                'CONVERT(COALESCE(SUM(product_sales.amount), 0), SIGNED) AS amount'
            ),
            'products.name AS products_name'
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
}
