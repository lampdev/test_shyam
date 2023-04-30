<?php

namespace Database\Factories;

use App\Models\Settings;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

class SettingsFactory extends Factory
{
    protected $model = Settings::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'key' => $this->faker->unique()->word(),
            'value' => $this->faker->sentence(),
            'tenant_id' => $this->faker->randomElement([Tenant::inRandomOrder()->first()->id ?? null, null]),
        ];
    }
}
