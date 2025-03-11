<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Airline\App\Request;

use Illuminate\Foundation\Http\FormRequest;
use Lightit\Backoffice\Airline\Domain\DataTransferModels\AirlineDto;

class StoreAirlineRequest extends FormRequest
{
    public const NAME = 'name';

    public const DESCRIPTION = 'description';

    public const CITIES = 'cities';

    public function rules(): array
    {
        return [
            self::NAME => ['required', 'string', 'max:255', 'unique:airlines'],
            self::DESCRIPTION => ['required', 'string'],
            self::CITIES => ['required', 'array'],
            self::CITIES . '.*' => ['exists:cities,id'],
        ];
    }

    public function toDto(): AirlineDto
    {
        return new AirlineDto(
            name: $this->string(self::NAME)->toString(),
            description: $this->string(self::DESCRIPTION)->toString(),
            cities: $this->array(self::CITIES),
        );
    }
}
