<?php

declare(strict_types=1);

namespace Lightit\Backoffice\City\App\Request;

use Illuminate\Foundation\Http\FormRequest;
use Lightit\Backoffice\City\Domain\DataTransferObjects\ListCityDto;

class ListCityRequest extends FormRequest
{
    public const AIRLINE = 'airline';

    public const SORT_BY = 'sortBy';

    public const SORT_ORDER = 'sortOrder';

    public function rules(): array
    {
        return [
            self::SORT_BY => ['nullable', 'string', 'in:id,name'],
            self::SORT_ORDER => ['nullable', 'string', 'in:asc,desc'],
            self::AIRLINE  => ['nullable', 'integer', 'exists:airlines,id'],
        ];
    }

    public function toDto(): ListCityDto
    {
        return new ListCityDto(
            sortBy: $this->string(self::SORT_BY)->toString(),
            sortOrder: $this->string(self::SORT_ORDER)->toString(),
            airline: $this->string(self::AIRLINE)->toString(),
        );
    }
}
