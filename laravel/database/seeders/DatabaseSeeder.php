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
        \App\Models\User::create([
            'name' => 'Ananda Bayu',
            'email' => 'bayu@gmail.com',
            'npp' => '12345',
            'npp_supervisor' => '11111',
            'password' => bcrypt('password12345')
        ]);

        \App\Models\User::create([
            'name' => 'Supervisor',
            'email' => 'spv@gmail.com',
            'npp' => '11111',
            'npp_supervisor' => '',
            'password' => bcrypt('password12345')
        ]);
    }
}
