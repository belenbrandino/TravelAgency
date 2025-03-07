<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Airline\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Lightit\Backoffice\Flight\Domain\Models\Flight;

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
