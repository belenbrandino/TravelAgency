<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Airline\Domain\Actions;

use Lightit\Backoffice\Airline\Domain\DataTransferModels\AirlineDto;
use Lightit\Backoffice\Airline\Domain\Models\Airline;

class StoreAirlineAction
{
    public function execute(AirlineDto $airlineDto): Airline
    {
        $airline = Airline::create([
            'name' => $airlineDto->getName(),
            'description' => $airlineDto->getDescription(),
        ]);

        $airline->cities()->attach($airlineDto->getCities());

        return $airline;
    }
}
