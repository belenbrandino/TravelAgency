<?php

declare(strict_types=1);

namespace Tests\Feature\Flight;

use Database\Factories\AirlineFactory;
use Database\Factories\CityFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Testing\Fluent\AssertableJson;
use Lightit\Backoffice\Flight\App\Transformers\FlightTransformer;
use Lightit\Backoffice\Flight\Domain\Models\Flight;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\postJson;

describe('flights', function () {
    /** @see StoreFlightController */
    it('can create a flight successfully', function () {
        $airline = AirlineFactory::new()->createOne();
        $origin = CityFactory::new()->createOne();
        $destination = CityFactory::new()->createOne();
        $airline->cities()->attach($origin);
        $airline->cities()->attach($destination);

        $flightData = [
            'airline_id'         => $airline->id,
            'origin_city_id'     => $origin->id,
            'destination_city_id'=> $destination->id,
            'departure_date'     => now()->addDay()->toDateTimeString(),
            'arrival_date'       => now()->addDays(2)->toDateTimeString(),
        ];

        $response = postJson(url('/api/flights'), $flightData);
        $response
            ->assertCreated();

        $flight = Flight::query()
            ->where('airline_id', $flightData['airline_id'])
            ->where('origin_city_id', $flightData['origin_city_id'])
            ->where('destination_city_id', $flightData['destination_city_id'])
            ->where('departure_date', $flightData['departure_date'])
            ->where('arrival_date', $flightData['arrival_date'])
            ->firstOrFail();

        $response
            ->assertCreated()
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->where('status', JsonResponse::HTTP_CREATED)
                    ->where('success', true)
                    ->has(
                        'data',
                        fn (AssertableJson $json) =>
                        $json->whereAll(
                            transformation($flight, FlightTransformer::class)->transform() ?? []
                        )
                    )
            );

        assertDatabaseHas('flights', [
            'airline_id' => $flightData['airline_id'],
            'origin_city_id' => $flightData['origin_city_id'],
            'destination_city_id' => $flightData['destination_city_id'],
            'departure_date' => $flightData['departure_date'],
            'arrival_date' => $flightData['arrival_date'],
        ]);
    });
});
