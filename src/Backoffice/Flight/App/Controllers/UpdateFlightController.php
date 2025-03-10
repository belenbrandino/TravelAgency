<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Flight\App\Controllers;

use Illuminate\Http\JsonResponse;
use Lightit\Backoffice\Flight\App\Request\UpdateFlightRequest;
use Lightit\Backoffice\Flight\App\Transformers\FlightTransformer;
use Lightit\Backoffice\Flight\Domain\Actions\UpdateFlightAction;
use Lightit\Backoffice\Flight\Domain\Models\Flight;

class UpdateFlightController
{
    public function __invoke(Flight $flight, UpdateFlightRequest $request, UpdateFlightAction $action): JsonResponse
    {
        $flight = $action->execute($flight, $request->toDto());

        return responder()
            ->success($flight, FlightTransformer::class)
            ->respond(JsonResponse::HTTP_CREATED);
    }
}
