<?php

declare(strict_types=1);

namespace Lightit\Backoffice\City\App\Request;

use Illuminate\Foundation\Http\FormRequest;

class StoreCityRequest extends FormRequest
{
    public const NAME = 'name';

    public function rules(): array
    {
        return [
            self::NAME => ['required', 'string', 'max:255'],
        ];
    }
}
