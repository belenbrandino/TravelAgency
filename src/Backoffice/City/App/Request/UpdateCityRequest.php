<?php

declare(strict_types=1);

namespace Lightit\Backoffice\City\App\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Lightit\Backoffice\City\Domain\DataTransferObjects\CityDto;

class UpdateCityRequest extends FormRequest
{
    public const NAME = 'name';

    public function rules(): array
    {
        return [
            self::NAME => ['required', 'string', 'max:255', Rule::unique('cities')->ignore($this->city->id)],
        ];
    }

    public function toDto(): CityDto
    {
        return new CityDto(
            name: $this->string(self::NAME)->toString(),
        );
    }
}
