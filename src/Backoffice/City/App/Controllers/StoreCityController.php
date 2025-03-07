<?php

declare(strict_types=1);

namespace Lightit\Backoffice\City\App\Controllers;

use Illuminate\Http\JsonResponse;
use Lightit\Backoffice\City\App\Request\StoreCityRequest;
use Lightit\Backoffice\City\App\Transformers\CityTransformer;
use Lightit\Backoffice\City\Domain\Actions\StoreCityAction;

class StoreCityController
{
    public function __invoke(StoreCityRequest $request, StoreCityAction $action): JsonResponse
    {
        $city = $action->execute($request->toDto());

        return responder()
            ->success($city, CityTransformer::class)
            ->respond(JsonResponse::HTTP_CREATED);
    }
}
