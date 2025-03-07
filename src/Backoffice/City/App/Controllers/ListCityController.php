<?php

declare(strict_types=1);

namespace Lightit\Backoffice\City\App\Controllers;

use Illuminate\Http\JsonResponse;
use Lightit\Backoffice\City\Domain\Actions\ListCityAction;
use Lightit\Backoffice\Employee\App\Transformers\CityTransformer;

class ListCityController
{
    public function __invoke(ListCityAction $action): JsonResponse
    {
        $cities = $action->execute();

        return responder()->success($cities, CityTransformer::class)->respond();
    }
}
