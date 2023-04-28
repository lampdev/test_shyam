# Trial task for Shyam

## Installation
1. Clone the repository.


2. Navigate to project folder


3. Run: ```composer install```


4. Run: ```npm install```


4. Run: ```php artisan migrate```


6. Run database seeders:
```
php artisan db:seed
```
To run specific seeder use ``` php artisan db:seed --class=seeder_name```. Use real seeder name instead of ```seeder_name```.
There are 3 seeders available:
 - ```UserSeeder``` - seeds Users with some metadata.
 - ```TenantSeeder``` - seeds Tenants and associates with Users,
 - ```SettingsSeeder``` - seeds Settings.

For example: ```php artisan db:seed --class=UserSeeder```.

### Completed tasks:
1. Created Laravel 8 App.


2. Added https://github.com/plank/laravel-metable package.


3. Add https://github.com/anlutro/laravel-settings package.


4. Wrote a factory for: App/Models/User and create a set of users.
```
./database/factories/UserFactory.php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    const DEFAULT_PASSWORD = 'password';

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make(self::DEFAULT_PASSWORD),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
```


5. Created a set of random data for the metable package for the User model.
```
./database/seeders/UserSeeder.php

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
```

6. Created a set of random data for the settings package.
```
./database/seeders/SettingsSeeder.php

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
```

7. Created a tenant model and added a set of tenants.

8. Associated the users to the tenants (some of them with multiple tenants).

9. Added the ability for settings to have tentant_id support by adding tentant_id to Settings table.
To set or get settings use:
```
// get
Setting::setExtraColumns(['tentant_id' => $tentant_id]);
Settings::get('foo');

// set
Settings::setExtraColumns(['tentant_id' => $tentant_id]);
Settings::set('foo', 'bar');
```

Created ```./app/Services/SettingsManager``` which extends ```anlutro/laravel-settings``` default ```SettingsManager``` with such methods:
```
public function allByTenant($tenantId); // get all by Tentant
public function getByTenant($key, $tenantId, $default = null); // get by Tentant
public function setByTenant($key, $value, $tenantId): void; // set with Tentant
```

10. Added layout similar to this layout (https://tailwindui.com/components/application-ui/lists/tables#component-822ab4bf111e9a34063e651275b381e6) using TailwindCSS.
