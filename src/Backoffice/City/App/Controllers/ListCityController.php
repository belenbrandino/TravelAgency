<?php

declare(strict_types=1);

namespace Lightit\Backoffice\City\App\Controllers;

use Illuminate\Http\JsonResponse;
use Lightit\Backoffice\City\App\Transformers\CityTransformer;
use Lightit\Backoffice\City\Domain\Actions\ListCityAction;

class ListCityController
{
    public function __invoke(ListCityAction $action): JsonResponse
    {
        $cities = $action->execute();

        return responder()->success($cities, CityTransformer::class)->respond();
    }
}
