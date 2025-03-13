<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Airline\App\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Lightit\Backoffice\Airline\Domain\DataTransferModels\AirlineDto;
use Lightit\Backoffice\Airline\Domain\Models\Airline;

class UpdateAirlineRequest extends FormRequest
{
    public const NAME = 'name';

    public const DESCRIPTION = 'description';

    public const CITIES = 'cities';

    public function rules(): array
    {
        /** @var Airline $airline */
        $airline = $this->airline;

        return [
            self::NAME => ['required', 'string', 'max:255', Rule::unique('airlines')->ignore($airline->id)],
            self::DESCRIPTION => ['required', 'string'],
            self::CITIES => ['required', 'array', 'exists:cities,id'],
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
