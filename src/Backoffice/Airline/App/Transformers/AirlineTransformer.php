<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Airline\App\Transformers;

use Flugg\Responder\Transformers\Transformer;
use Illuminate\Database\Eloquent\Collection;
use Lightit\Backoffice\Airline\Domain\Models\Airline;
use Lightit\Backoffice\City\Domain\Models\City;

class AirlineTransformer extends Transformer
{
    /**
     * @return array{id: int, name: string, description: string, cities: Collection <int, City>}
    */
    public function transform(Airline $airline): array
    {
        return [
            'id' => $airline->id,
            'name' => $airline->name,
            'description' => $airline->description,
            'cities' => $airline->cities,
        ];
    }
}
