<?php

declare(strict_types=1);

namespace Lightit\Backoffice\City\App\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Lightit\Backoffice\City\Domain\DataTransferObjects\CityDto;
use Lightit\Backoffice\City\Domain\Models\City;

class UpdateCityRequest extends FormRequest
{
    public const NAME = 'name';

    public function rules(): array
    {
        /** @var City $city */
        $city = $this->city;

        return [
            self::NAME => ['required', 'string', 'max:255', Rule::unique('cities')->ignore($city->id)],
        ];
    }

    public function toDto(): CityDto
    {
        return new CityDto(
            name: $this->string(self::NAME)->toString(),
        );
    }
}
