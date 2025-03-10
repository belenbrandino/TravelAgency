<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Airline\App\Transformers;

use Flugg\Responder\Transformers\Transformer;
use Lightit\Backoffice\Airline\Domain\Models\Airline;

class AirlineTransformer extends Transformer
{
    /**
     * @return array{id: int, name: string, description: string}
    */
    public function transform(Airline $airline): array
    {
        return [
            'id' => $airline->id,
            'name' => $airline->name,
            'description' => $airline->description,
        ];
    }
}
