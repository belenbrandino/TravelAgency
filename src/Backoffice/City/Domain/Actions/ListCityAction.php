<?php

declare(strict_types=1);

namespace Lightit\Backoffice\City\Domain\Actions;

use Illuminate\Database\Eloquent\Collection;
use Lightit\Backoffice\City\Domain\Models\City;

class ListCityAction
{
    /**
     * @return Collection <int, City>
    */
    public function execute(): Collection
    {
        return City::all();
    }
}
