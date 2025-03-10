<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Flight\App\Controllers;

use Illuminate\Http\JsonResponse;
use Lightit\Backoffice\Flight\App\Transformers\FlightTransformer;
use Lightit\Backoffice\Flight\Domain\Models\Flight;

class ListFlightController
{
    public function __invoke(): JsonResponse
    {
        $flights = Flight::all();

        return responder()->success($flights, FlightTransformer::class)->respond();
    }
}
