<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Flight\Domain\DataTransferModels;

class FlightDto
{
    public function __construct(
        private readonly int $airline_id,
        private readonly int $origin_city_id,
        private readonly int $destination_city_id,
        private readonly string $departure_date,
        private readonly string $arrival_date,
    ) {
    }

    public function getAirlineID(): int
    {
        return $this->airline_id;
    }

    public function getOriginCity(): int
    {
        return $this->origin_city_id;
    }

    public function getDestinationCity(): int
    {
        return $this->destination_city_id;
    }

    public function getDepartureDate(): string
    {
        return $this->departure_date;
    }

    public function getArrivalDate(): string
    {
        return $this->arrival_date;
    }
}
