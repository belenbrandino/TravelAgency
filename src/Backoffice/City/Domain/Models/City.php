<?php

declare(strict_types=1);

namespace Lightit\Backoffice\City\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Lightit\Backoffice\Flight\Domain\Models\Flight;

/**
 * @property int                             $id
 * @property string                          $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Flight> $incomingFlights
 * @property-read int|null $incoming_flights_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Flight> $outgoingFlights
 * @property-read int|null $outgoing_flights_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
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
