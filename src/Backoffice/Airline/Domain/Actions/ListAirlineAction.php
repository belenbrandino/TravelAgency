<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Airline\Domain\Actions;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;
use Lightit\Backoffice\Airline\Domain\Models\Airline;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ListAirlineAction
{
    /**
     * @return Paginator <Airline>
    */
    public function execute(): Paginator
    {
        /** @var Paginator<Airline> */
        return QueryBuilder::for(Airline::class)
            ->allowedFilters([
                AllowedFilter::callback('active_flights', function (Builder $query, string $value) {
                    $query->whereHas('flights', function ($q) {
                        $q->where('departure_date', '>=', now());
                    }, '>=', (int) $value);
                }),
                AllowedFilter::callback('city', function (Builder $query, string $value) {
                    $query->whereHas('cities', function ($q) use ($value) {
                        $q->where('cities.id', (int) $value);
                    });
                }),
            ])
            ->allowedSorts('name', 'id', 'created_at', 'updated_at')
            ->defaultSort('-updated_at', '-created_at')
            ->with('cities')
            ->simplePaginate();
    }
}
