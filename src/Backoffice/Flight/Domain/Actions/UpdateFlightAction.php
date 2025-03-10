<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Flight\Domain\Actions;

use Lightit\Backoffice\Flight\Domain\DataTransferModels\FlightDto;
use Lightit\Backoffice\Flight\Domain\Models\Flight;

class UpdateFlightAction
{
    public function execute(Flight $flight, FlightDto $flightDto): Flight
    {
        $flight->update([
            'airline_id' => $flightDto->getAirlineID(),
            'origin_city_id' => $flightDto->getOriginCity(),
            'destination_city_id' => $flightDto->getDestinationCity(),
            'departure_date' => $flightDto->getDepartureDate(),
            'arrival_date' => $flightDto->getArrivalDate(),
        ]);

        return $flight;
    }
}
