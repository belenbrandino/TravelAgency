<?php

declare(strict_types=1);

namespace Lightit\Backoffice\City\Domain\Actions;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;
use Lightit\Backoffice\City\Domain\Models\City;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ListCityAction
{
    /**
     * @return Paginator <City>
    */
    public function execute(): Paginator
    {
        /** @var Paginator<City> */
        return QueryBuilder::for(City::class)
            ->allowedFilters([
                AllowedFilter::callback('airline', function (Builder $query, $value) {
                    $query->whereHas('airlines', function ($q) use ($value) {
                        $q->where('airlines.id', $value);
                    });
                }),
            ])
            ->allowedSorts('name', 'id', 'created_at', 'updated_at')
            ->defaultSort('-updated_at', '-created_at')
            ->simplePaginate();
    }
}
