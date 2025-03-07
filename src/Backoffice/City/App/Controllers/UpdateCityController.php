<?php

declare(strict_types=1);

namespace Lightit\Backoffice\City\App\Controllers;

use Illuminate\Http\JsonResponse;
use Lightit\Backoffice\City\App\Request\UpdateCityRequest;
use Lightit\Backoffice\City\App\Transformers\CityTransformer;
use Lightit\Backoffice\City\Domain\Actions\UpdateCityAction;
use Lightit\Backoffice\City\Domain\Models\City;

class UpdateCityController
{
    public function __invoke(City $city, UpdateCityRequest $request, UpdateCityAction $action): JsonResponse
    {
        $updatedCity = $action->execute($city, $request->toDto());

        return responder()
            ->success($updatedCity, CityTransformer::class)
            ->respond();
    }
}
