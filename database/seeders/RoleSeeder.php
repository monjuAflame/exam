<?php

namespace Database\Seeders;

use Exception;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        try {
            $admin = User::where('phone', '0189400400')->first() ?? User::create([
                'first_name' => 'Admin',
                'last_name' => null,
                'phone' => '0189400400',
                'email' => 'admin@admin.com',
                'avatar' => null,
                'password' => Hash::make('123456'),
            ]);

            $role = Role::where('name', 'admin')->first() ?? Role::create(['name' => 'admin']);

            $admin->assignRole($role);
            logger(json_encode($admin->getRoleNames()));

            $moderator = User::where('phone', '0189400401')->first() ?? User::create([
                'first_name' => 'Moderator',
                'last_name' => null,
                'phone' => '0189400401',
                'email' => 'moderator@moderator.com',
                'avatar' => null,
                'password' => Hash::make('123456'),
            ]);

            $moderatorRole = Role::where('name', 'moderator')->first() ?? Role::create(['name' => 'moderator']);

            $admin->assignRole($moderatorRole);

            Role::where('name', 'student')->first() ?? Role::create(['name' => 'student']);

        } catch (Exception $e) {
            logger($e->getMessage());
        }
    }
}
