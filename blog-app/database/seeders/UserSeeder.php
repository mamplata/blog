<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'John Loui Amular',
            'email' => 'john@gmail.com',
            'password' => 'password123',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // You can add more sample users here
        DB::table('users')->insert([
            'name' => 'Kyle Deejay Mamplata',
            'email' => 'deejay@gmail.com',
            'password' => 'password456',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // You can add more sample users here
        DB::table('users')->insert([
            'name' => 'Adrian James Boncales',
            'email' => 'james@gmail.com',
            'password' => 'password456',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
