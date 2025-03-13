<?php

declare(strict_types=1);

namespace Tests\Feature\Flight;

use Database\Factories\AirlineFactory;
use Database\Factories\CityFactory;
use Database\Factories\FlightFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Testing\Fluent\AssertableJson;
use Lightit\Backoffice\Flight\App\Transformers\FlightTransformer;
use Lightit\Backoffice\Flight\Domain\Models\Flight;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\putJson;

describe('flights', function () {
    /** @see UpdateFlightController */
    it('can update a flight successfully', function () {
        $flight = FlightFactory::new()->createOne();
        $airline = AirlineFactory::new()->createOne();
        $origin = CityFactory::new()->createOne();
        $destination = CityFactory::new()->createOne();
        $airline->cities()->attach($origin);
        $airline->cities()->attach($destination);

        $updatedData = [
            'airline_id'         => $airline->id,
            'origin_city_id'     => $origin->id,
            'destination_city_id'=> $destination->id,
            'departure_date'     => now()->addDay()->toDateTimeString(),
            'arrival_date'       => now()->addDays(2)->toDateTimeString(),
        ];

        $response = putJson(url("/api/flights/{$flight->id}"), $updatedData)
        ->assertSuccessful()
        ->assertJson([
            'status' => JsonResponse::HTTP_OK,
            'success' => true,
            'data' => $updatedData,
        ]);

        $flight = Flight::query()
            ->where('airline_id', $updatedData['airline_id'])
            ->where('origin_city_id', $updatedData['origin_city_id'])
            ->where('destination_city_id', $updatedData['destination_city_id'])
            ->where('departure_date', $updatedData['departure_date'])
            ->where('arrival_date', $updatedData['arrival_date'])
            ->firstOrFail();

        $response
            ->assertSuccessful()
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->where('status', JsonResponse::HTTP_OK)
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
            'airline_id' => $updatedData['airline_id'],
            'origin_city_id' => $updatedData['origin_city_id'],
            'destination_city_id' => $updatedData['destination_city_id'],
            'departure_date' => $updatedData['departure_date'],
            'arrival_date' => $updatedData['arrival_date'],
        ]);
    });
});
