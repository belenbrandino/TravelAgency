<?php

declare(strict_types=1);

namespace Lightit\Backoffice\City\App\Controllers;

use Illuminate\Http\JsonResponse;
use Lightit\Backoffice\City\Domain\Actions\GetCityAction;
use Lightit\Backoffice\City\Domain\Models\City;
use Lightit\Backoffice\Employee\App\Transformers\CityTransformer;

class GetCityController
{
    public function __invoke(GetCityAction $action, City $city): JsonResponse
    {
        $city = $action->execute($city);

        return responder()->success($city, CityTransformer::class)->respond();
    }
}
