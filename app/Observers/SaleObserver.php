<?php

namespace App\Observers;

use App\Models\Sale;
use Illuminate\Support\Str;

class SaleObserver
{
    /**
     * Handle the Sale "creating" event.
     *
     * @param  \App\Models\Sale  $sale
     * @return void
     */
    public function creating(Sale $sale)
    {
        $sale->identify = Str::uuid()->toString();
        $sale->date = date('Y-m-d');
    }
}
