<?php

declare(strict_types=1);

namespace Tests\Feature\Flight;

use Database\Factories\FlightFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Testing\Fluent\AssertableJson;

use function Pest\Laravel\getJson;

describe('flights', function () {
    /** @see GetFlightController */
    it('can get a flight successfully', function () {
        $flight = FlightFactory::new()->createOne();

        $expectedFlight = [
            'id' => $flight->id,
            'airline_id' => $flight->airline_id,
            'origin_city_id' => $flight->origin_city_id,
            'destination_city_id' => $flight->destination_city_id,
            'departure_date' => $flight->departure_date,
            'arrival_date' => $flight->arrival_date,
        ];

        getJson(url("/api/flights/{$flight->id}"))
            ->assertSuccessful()
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->where('status', JsonResponse::HTTP_OK)
                    ->where('success', true)
                    ->where('data', $expectedFlight)
            );
    });
});
