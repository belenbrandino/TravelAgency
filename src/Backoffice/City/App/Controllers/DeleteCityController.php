<?php

declare(strict_types=1);

namespace Lightit\Backoffice\City\App\Controllers;

use Lightit\Backoffice\City\Domain\Models\City;

class DeleteCityController
{
    public function execute(City $city): void
    {
        $city->delete();
    }
}
