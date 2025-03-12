<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Airline\App\Transformers;

use Flugg\Responder\Transformers\Transformer;
use Lightit\Backoffice\Airline\Domain\Models\Airline;
use Lightit\Backoffice\City\App\Transformers\CityTransformer;

class AirlineTransformer extends Transformer
{
    public function transform(Airline $airline): array
    {
        $citiesTransformed = $airline->cities->map(fn ($city) => (new CityTransformer())->transform($city));

        return [
            'id' => $airline->id,
            'name' => $airline->name,
            'description' => $airline->description,
            'cities' => $citiesTransformed,
        ];
    }
}
