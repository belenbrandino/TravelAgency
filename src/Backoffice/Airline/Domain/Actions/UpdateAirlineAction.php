<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Airline\Domain\Actions;

use Lightit\Backoffice\Airline\Domain\DataTransferModels\AirlineDto;
use Lightit\Backoffice\Airline\Domain\Models\Airline;

class UpdateAirlineAction
{
    public function execute(Airline $airline, AirlineDto $airlineDto): Airline
    {
        $airline->update([
            'name' => $airlineDto->getName(),
            'description' => $airlineDto->getDescription(),
        ]);

        return $airline;
    }
}
