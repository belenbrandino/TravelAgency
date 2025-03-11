<?php

declare(strict_types=1);

namespace Database\Seeders;

use Database\Factories\FlightFactory;
use Illuminate\Database\Seeder;

class FlightSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        FlightFactory::new()->count(10)->create();
    }
}
