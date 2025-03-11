<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Airline\Domain\Exceptions;

use Exception;

class InvalidCityAirlineException extends Exception
{
    public static function cityNotInAirline(string $cityType, int $cityId): self
    {
        return new self("Airline does not operate in the indicated {$cityType} city: {$cityId}");
    }

    public static function cityNotFound(int $cityId): self
    {
        return new self("City with {$cityId} id not found.");
    }

    public static function airlineNotFound(int $airlineId): self
    {
        return new self("Airline with {$airlineId} id not found.");
    }
}
