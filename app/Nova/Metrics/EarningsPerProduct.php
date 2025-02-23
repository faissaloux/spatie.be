<?php

namespace App\Nova\Metrics;

use App\Domain\Shop\Models\Product;
use App\Domain\Shop\Models\Purchase;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;

class EarningsPerProduct extends Partition
{
    public function calculate(NovaRequest $request)
    {
        return $this->sum(
            $request,
            Purchase::query()
                ->whereHas('receipt', function (Builder $query): void {
                    $query->where('amount', '!=', 0);
                })
                ->select(['purchases.*', 'purchasables.product_id'])
                ->join('purchasables', 'purchasables.id', '=', 'purchases.purchasable_id')
                ->orderByDesc('aggregate'),
            'earnings',
            'product_id',
        )->label(function ($value) {
            return Product::find($value)->title;
        });
    }

    public function uriKey()
    {
        return 'earnings-per-product';
    }
}
