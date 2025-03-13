<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Flight\App\Controllers;

use Illuminate\Http\JsonResponse;
use Lightit\Backoffice\Flight\App\Request\StoreFlightRequest;
use Lightit\Backoffice\Flight\App\Transformers\FlightTransformer;
use Lightit\Backoffice\Flight\Domain\Actions\StoreFlightAction;

class StoreFlightController
{
    public function __invoke(StoreFlightRequest $request, StoreFlightAction $action): JsonResponse
    {
        $flight = $action->execute($request->toDto());

        return responder()
            ->success($flight, FlightTransformer::class)
            ->respond(JsonResponse::HTTP_CREATED);
    }
}
