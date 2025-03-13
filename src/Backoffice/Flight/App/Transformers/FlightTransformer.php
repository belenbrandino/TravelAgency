<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Flight\App\Transformers;

use Flugg\Responder\Transformers\Transformer;
use Lightit\Backoffice\Flight\Domain\Models\Flight;

class FlightTransformer extends Transformer
{
    /**
     * @return array{id: int,
     * airline_id: int,
     * origin_city_id: int,
     * destination_city_id: int,
     * departure_date: string,
     * arrival_date: string
     * }
    */
    public function transform(Flight $flight): array
    {
        return [
            'id' => $flight->id,
            'airline_id' => $flight->airline_id,
            'origin_city_id' => $flight->origin_city_id,
            'destination_city_id' => $flight->destination_city_id,
            'departure_date' => $flight->departure_date,
            'arrival_date' => $flight->arrival_date,
        ];
    }
}
