<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Lightit\Backoffice\Flight\Domain\Models\Flight;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Flight>
 */
class FlightFactory extends Factory
{
    protected $model = Flight::class;

    public function definition(): array
    {
        $departure_date = $this->faker->dateTimeBetween('now', '+1 days');
        $arrival_date = (clone $departure_date)->modify('+6 hours');
        return [
            'airline_id' => AirlineFactory::new()->withCities()->create(),
            'origin_city_id' => CityFactory::new(),
            'destination_city_id' => CityFactory::new(),
            'departure_date' => $departure_date->format('Y-m-d H:i:s'),
            'arrival_date' => $arrival_date->format('Y-m-d H:i:s')
        ];
    }

}
