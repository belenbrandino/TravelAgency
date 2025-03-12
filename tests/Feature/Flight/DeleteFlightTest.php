<?php

declare(strict_types=1);

namespace Tests\Feature\Flight;

use Database\Factories\FlightFactory;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\deleteJson;

describe('flights', function () {
    /** @see DeleteFlightController */
    it('can delete a flight successfully', function () {
        $flight = FlightFactory::new()->createOne();

        deleteJson(url("/api/flights/{$flight->id}"))
            ->assertSuccessful()
            ->assertNoContent();

        assertDatabaseMissing('flights', [
            'id' => $flight->id,
        ]);
    });
});
