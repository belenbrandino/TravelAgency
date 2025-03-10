<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Airline\App\Controllers;

use Illuminate\Http\JsonResponse;
use Lightit\Backoffice\Airline\App\Transformers\AirlineTransformer;
use Lightit\Backoffice\Airline\Domain\Models\Airline;

class ListAirlineController
{
    public function __invoke(): JsonResponse
    {
        $airlines = Airline::all();

        return responder()->success($airlines, AirlineTransformer::class)->respond();
    }
}
