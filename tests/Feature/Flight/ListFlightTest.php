<?php

declare(strict_types=1);

namespace Tests\Feature\Flight;

use Database\Factories\FlightFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Testing\Fluent\AssertableJson;
use Lightit\Backoffice\Flight\App\Transformers\FlightTransformer;
use function Pest\Laravel\getJson;

describe('flights', function () {
    /** @see ListFlightController */
    it('can list flights successfully', function () {
        $flights = FlightFactory::new()
            ->count(5)->create();

        getJson(url('/api/flights'))
            ->assertSuccessful()
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->where('status', JsonResponse::HTTP_OK)
                    ->where('success', true)
                    ->has('data', 5)
                    ->has(
                        'data',
                        fn (AssertableJson $json) =>
                        $json->whereAll(
                            transformation($flights, FlightTransformer::class)->transform() ?? []
                        )
                    )
            );
    });
});
