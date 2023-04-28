<?php

namespace Database\Seeders;

use anlutro\LaravelSettings\Facades\Setting;
use Faker\Generator;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(Generator::class);

        collect()->times(
            $faker->numberBetween(3, 7),
            function () use ($faker) {
                return Setting::set(
                    $faker->unique()->word(),
                    $faker->sentence()
                );
            }
        );

        Setting::save();
    }
}
