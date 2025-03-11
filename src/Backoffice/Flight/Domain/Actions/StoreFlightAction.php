<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Flight\Domain\Actions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Lightit\Backoffice\Airline\Domain\Exceptions\InvalidCityAirlineException;
use Lightit\Backoffice\Airline\Domain\Models\Airline;
use Lightit\Backoffice\City\Domain\Models\City;
use Lightit\Backoffice\Flight\Domain\DataTransferModels\FlightDto;
use Lightit\Backoffice\Flight\Domain\Models\Flight;

class StoreFlightAction
{
    public function execute(FlightDto $flightDto): Flight
    {
        try {
            $airline = Airline::findOrFail($flightDto->getAirlineID());
            $operating_cities_airline = $airline->cities->pluck('id')->toArray();
        } catch (ModelNotFoundException $e) {
            throw InvalidCityAirlineException::airlineNotFound($flightDto->getAirlineID());
        }

        try {
            $origin_city = City::findOrFail($flightDto->getOriginCity());
        } catch (ModelNotFoundException) {
            throw InvalidCityAirlineException::cityNotFound($flightDto->getOriginCity());
        }

        try {
            $destination_city = City::findOrFail($flightDto->getDestinationCity());
        } catch (ModelNotFoundException) {
            throw InvalidCityAirlineException::cityNotFound($flightDto->getDestinationCity());
        }

        if (! in_array($origin_city->id, $operating_cities_airline)) {
            throw InvalidCityAirlineException::cityNotInAirline('origin', $origin_city->id);
        }

        if (! in_array($destination_city->id, $operating_cities_airline)) {
            throw InvalidCityAirlineException::cityNotInAirline('destination', $destination_city->id);
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
