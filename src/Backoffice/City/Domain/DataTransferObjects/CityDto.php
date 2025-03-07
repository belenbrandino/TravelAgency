<?php

declare(strict_types=1);

namespace Lightit\Backoffice\City\Domain\DataTransferObjects;

class CityDto
{
    public function __construct(
        private readonly string $name) {
    }

    public function getName(): string
    {
        return $this->name;
    }
}
