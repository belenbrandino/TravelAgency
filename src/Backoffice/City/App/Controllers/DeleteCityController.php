<?php

declare(strict_types=1);

namespace Lightit\Backoffice\City\App\Controllers;

use Illuminate\Http\JsonResponse;
use Lightit\Backoffice\City\Domain\Models\City;

class DeleteCityController
{
    public function __invoke(City $city): JsonResponse
    {
        $city->incomingFlights()->delete();
        $city->outgoingFlights()->delete();
        $city->delete();

        return responder()->success()->respond(JsonResponse::HTTP_NO_CONTENT);
    }
}
