<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(20)->create();
        User::create([
            'name' => 'test',
            'email' => 'test@test.test',
            'password' => Hash::make('12345678'),
        ]);
    }
}
