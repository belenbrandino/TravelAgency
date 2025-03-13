<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Airline\App\Controllers;

use Illuminate\Http\JsonResponse;
use Lightit\Backoffice\Airline\Domain\Models\Airline;

class DeleteAirlineController
{
    public function __invoke(Airline $airline): JsonResponse
    {
        $airline->flights()->delete();
        $airline->delete();

        return responder()
            ->success()
            ->respond(JsonResponse::HTTP_NO_CONTENT);
    }
}
