<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (!\App\Models\User::where('email', $email = 'local@local.com')->count()) {
            \App\Models\User::factory()->create(['email' => $email]);    
        }
        \App\Models\User::factory(rand(1, 15))->create();
    }
}
