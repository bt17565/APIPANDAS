<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate([
            'email' => 'altynay.uk@gmail.com'
        ],[
            'name' => 'Antynay Khairullina',
            'password' => bcrypt('1234567890'),
            'role' => 'A',
        ]);
    }
}
