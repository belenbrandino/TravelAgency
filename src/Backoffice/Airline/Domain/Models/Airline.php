<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Airline\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Lightit\Backoffice\Flight\Domain\Models\Flight;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Flight> $flights
 * @property-read int|null $flights_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Airline newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Airline newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Airline query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Airline whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Airline whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Airline whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Airline whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Airline whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Airline extends Model
{
    protected $guarded = ['id'];

    /**
     * @return HasMany<Flight, $this>
    */
    public function flights(): HasMany
    {
        return $this->hasMany(Flight::class);
    }
}
