<?php

namespace Database\Seeders;

use App\Models\AuthorizedDevice;
use App\Models\LoginHistory;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create([
            'name' => 'casinoman',
            'email' => 'default@casinoman.app',
            'password' => Hash::make('casinomanPassword'),
            'email_verified_at' => now(),
        ]);

        $user->assignRole(Role::ADMIN);

        LoginHistory::factory()->create(['user_id' => $user]);
        AuthorizedDevice::factory()->create(['user_id' => $user]);
    }
}
