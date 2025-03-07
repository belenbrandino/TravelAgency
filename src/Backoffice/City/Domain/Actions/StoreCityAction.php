<?php

declare(strict_types=1);

namespace Lightit\Backoffice\City\Domain\Actions;

use Lightit\Backoffice\City\Domain\DataTransferObjects\CityDto;
use Lightit\Backoffice\City\Domain\Models\City;

class StoreCityAction
{
    public function execute(CityDto $cityDto): City
    {
        return City::create([
            'name' => $cityDto->getName(),
        ]);
    }
}
