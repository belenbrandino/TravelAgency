<?php

declare(strict_types=1);

namespace Lightit\Backoffice\City\Domain\Actions;

use Lightit\Backoffice\City\Domain\Models\City;

class GetCityAction
{
    public function execute(City $city): City
    {
        return $city;
    }
}
