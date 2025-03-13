<?php

declare(strict_types=1);

namespace Lightit\Backoffice\City\Domain\Actions;

use Lightit\Backoffice\City\Domain\DataTransferObjects\CityDto;
use Lightit\Backoffice\City\Domain\Models\City;

class UpdateCityAction
{
    public function execute(City $city, CityDto $cityDto): City
    {
        $city->update([
            'name' => $cityDto->getName(),
        ]);

        return $city;
    }
}
