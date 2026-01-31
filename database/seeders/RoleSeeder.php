<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Give admin role to admin@example.com if exists
        $admin = User::where('email', 'admin@example.com')->first();
        if ($admin) {
            $admin->role = 'admin';
            $admin->save();
        }
    }
}
