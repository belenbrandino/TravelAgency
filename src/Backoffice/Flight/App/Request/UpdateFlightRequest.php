<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Flight\App\Request;

use Illuminate\Foundation\Http\FormRequest;
use Lightit\Backoffice\Flight\Domain\DataTransferModels\FlightDto;

class UpdateFlightRequest extends FormRequest
{
    public const AIRLINE_ID = 'airline_id';

    public const ORIGIN_CITY_ID = 'origin_city_id';

    public const DESTINATION_CITY_ID = 'destination_city_id';

    public const DEPARTURE_DATE = 'departure_date';

    public const ARRIVAL_DATE = 'arrival_date';

    public function rules(): array
    {
        return [
            self::AIRLINE_ID => ['required', 'integer', 'exists:airlines,id'],
            self::ORIGIN_CITY_ID => ['required', 'integer', 'exists:cities,id'],
            self::DESTINATION_CITY_ID => ['required', 'integer', 'exists:cities,id', 'different:origin_city_id'],
            self::DEPARTURE_DATE => ['required', 'date'],
            self::ARRIVAL_DATE => ['required', 'date', 'after:departure_date'],

        ];
    }

    public function toDto(): FlightDto
    {
        return new FlightDto(
            airline_id: $this->integer(self::AIRLINE_ID),
            origin_city_id: $this->integer(self::ORIGIN_CITY_ID),
            destination_city_id: $this->integer(self::DESTINATION_CITY_ID),
            departure_date: $this->string(self::DEPARTURE_DATE)->toString(),
            arrival_date: $this->string(self::ARRIVAL_DATE)->toString(),
        );
    }
}
