<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Flight\Domain\Actions;

use Lightit\Backoffice\Flight\Domain\DataTransferModels\FlightDto;
use Lightit\Backoffice\Flight\Domain\Models\Flight;

class StoreFlightAction
{
    public function execute(FlightDto $flightDto): Flight
    {
        return Flight::create([
            'airline_id' => $flightDto->getAirlineID(),
            'origin_city_id' => $flightDto->getOriginCity(),
            'destination_city_id' => $flightDto->getDestinationCity(),
            'departure_date' => $flightDto->getDepartureDate(),
            'arrival_date' => $flightDto->getArrivalDate(),
        ]);
    }
}
