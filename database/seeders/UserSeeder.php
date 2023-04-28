<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(Faker::class);

        User::factory(10)
            ->create()
            ->each(function (User $user) use ($faker) {
                $user->setManyMeta([
                    'age' => $faker->numberBetween(18, 65),
                    'gender' => $faker->randomElement(User::GENDERS),
                    'address' => $faker->address(),
                ]);
            });
    }
}
