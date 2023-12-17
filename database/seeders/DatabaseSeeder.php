<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'name' => 'Shaheen Food Admin (Arman)',
            'email' => 'arman@panacea.live',
            'password' => bcrypt('password'),
            'phone_number' => '01947423947',
            'role' => 'panacea'
        ]);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        // \App\Models\Check::factory(500)->create();
    }
}
