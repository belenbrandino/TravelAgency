<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Flight\Domain\Actions;

use Lightit\Backoffice\Airline\Domain\Exceptions\InvalidCityAirlineException;
use Lightit\Backoffice\Airline\Domain\Models\Airline;
use Lightit\Backoffice\Flight\Domain\DataTransferModels\FlightDto;
use Lightit\Backoffice\Flight\Domain\Models\Flight;

class StoreFlightAction
{
    public function execute(FlightDto $flightDto): Flight
    {
        $airline = Airline::findOrFail($flightDto->getAirlineID());
        $operating_cities_airline = $airline->cities->pluck('id')->toArray();

        $originCityID = $flightDto->getOriginCity();
        $destinationCityID = $flightDto->getDestinationCity();

        if (! in_array($originCityID, $operating_cities_airline)) {
            throw new InvalidCityAirlineException(
                "Airline {$airline->name} does not operate in the indicated destination city: {$originCityID}"
            );
        }

        if (! in_array($destinationCityID, $operating_cities_airline)) {
            throw new InvalidCityAirlineException(
                "Airline {$airline->name} does not operate in the indicated destination city: {$destinationCityID}"
            );
        }

        return Flight::create([
            'airline_id' => $flightDto->getAirlineID(),
            'origin_city_id' => $flightDto->getOriginCity(),
            'destination_city_id' => $flightDto->getDestinationCity(),
            'departure_date' => $flightDto->getDepartureDate(),
            'arrival_date' => $flightDto->getArrivalDate(),
        ]);
    }
}
