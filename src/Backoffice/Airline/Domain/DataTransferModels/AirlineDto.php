<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Airline\Domain\DataTransferModels;

class AirlineDto
{
    public function __construct(
        private readonly string $name,
        private readonly string $description,
        private readonly array $cities,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCities(): array
    {
        return $this->cities;
    }
}
