<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Lightit\Backoffice\Airline\Domain\Models\Airline;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Airline>
 */
class AirlineFactory extends Factory
{
    protected $model = Airline::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->company(),
            'description' => $this->faker->paragraph(),

        ];
    }

    public function withCities(int $count = 2): AirlineFactory
    {
        return $this->afterCreating(function (Airline $airline) use ($count) {
            $cities = CityFactory::new()->count($count)->create();
            $airline->cities()->attach($cities->pluck('id'));
        });
    }

}
