<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Airline\App\Controllers;

use Illuminate\Http\JsonResponse;
use Lightit\Backoffice\Airline\App\Transformers\AirlineTransformer;
use Lightit\Backoffice\Airline\Domain\Actions\ListAirlineAction;

class ListAirlineController
{
    public function __invoke(
        ListAirlineAction $listAirlineAction,
    ): JsonResponse {
        $airlines = $listAirlineAction->execute();

        return responder()
            ->success($airlines, AirlineTransformer::class)
            ->respond();
    }
}
