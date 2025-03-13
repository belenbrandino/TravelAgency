<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Airline\App\Controllers;

use Illuminate\Http\JsonResponse;
use Lightit\Backoffice\Airline\App\Request\StoreAirlineRequest;
use Lightit\Backoffice\Airline\App\Transformers\AirlineTransformer;
use Lightit\Backoffice\Airline\Domain\Actions\StoreAirlineAction;

class StoreAirlineController
{
    public function __invoke(StoreAirlineRequest $request, StoreAirlineAction $action): JsonResponse
    {
        $airline = $action->execute($request->toDto());

        return responder()
            ->success($airline, AirlineTransformer::class)
            ->respond(JsonResponse::HTTP_CREATED);
    }
}
