<?php

declare(strict_types=1);

namespace Lightit\Backoffice\City\App\Request;

use Illuminate\Foundation\Http\FormRequest;
use Lightit\Backoffice\City\Domain\DataTransferObjects\CityDto;

class StoreCityRequest extends FormRequest
{
    public const NAME = 'name';

    public function rules(): array
    {
        return [
            self::NAME => ['required', 'string', 'max:255', 'unique:cities,name'],
        ];
    }

    public function toDto(): CityDto
    {
        return new CityDto(
            name: $this->string(self::NAME)->toString(),
        );
    }
}
