<?php

declare(strict_types=1);

namespace Lightit\Backoffice\City\Domain\DataTransferObjects;

class ListCityDto
{
    public function __construct(
        private readonly string $sortBy,
        private readonly string $sortOrder,
        private readonly string $airline,
    ) {
    }

    public function getSortBy(): string
    {
        return $this->sortBy;
    }

    public function getSortOrder(): string
    {
        return $this->sortOrder;
    }

    public function getAirline(): string
    {
        return $this->airline;
    }
}
