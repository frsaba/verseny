<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'Példa József', 'email' => 'jozsi@pelda.hu'],
            ['name' => 'Példa Károly', 'email' => 'karcsi@pelda.hu'],
            ['name' => 'Példa János', 'email' => 'janos@pelda.hu'],
            ['name' => 'Példa Krisztián', 'email' => 'krisztian@pelda.hu'],
            ['name' => 'Példa Rudolf', 'email' => 'rudi@pelda.hu'],
        ];

        foreach ($users as $user) {
            \DB::table('users')->insert($user);
        }
    }
}
