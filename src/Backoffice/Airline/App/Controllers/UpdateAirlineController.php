<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Airline\App\Controllers;

use Illuminate\Http\JsonResponse;
use Lightit\Backoffice\Airline\App\Request\UpdateAirlineRequest;
use Lightit\Backoffice\Airline\App\Transformers\AirlineTransformer;
use Lightit\Backoffice\Airline\Domain\Actions\UpdateAirlineAction;
use Lightit\Backoffice\Airline\Domain\Models\Airline;

class UpdateAirlineController
{
    public function __invoke(Airline $airline, UpdateAirlineRequest $request, UpdateAirlineAction $action): JsonResponse
    {
        $airline = $action->execute($airline, $request->toDto());

        return responder()
            ->success($airline, AirlineTransformer::class)
            ->respond(JsonResponse::HTTP_CREATED);
    }
}
