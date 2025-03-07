<?php

declare(strict_types=1);

namespace Lightit\Backoffice\City\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Lightit\Backoffice\Flight\Domain\Models\Flight;

class City extends Model
{
    protected $guarded = ['id'];

    /**
     * @return HasMany<Flight, $this>
    */
    public function incomingFlights(): HasMany
    {
        return $this->hasMany(Flight::class, 'destination_city_id');
    }

    /**
     * @return HasMany<Flight, $this>
    */
    public function outgoingFlights(): HasMany
    {
        return $this->hasMany(Flight::class, 'origin_city_id');
    }
}
