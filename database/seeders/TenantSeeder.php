<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenants = Tenant::factory(5)->create();

        User::all()->each(function (User $user) use ($tenants) {
            $tenantsToAssign = $tenants->random(random_int(1, 2));
            $user->tenants()->attach($tenantsToAssign);
        });
    }
}
