<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        foreach (range(1, 10) as $index) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'),
                'role' => $faker->randomElement(['admin', 'manager', 'employee']),
                'capabilities' => json_encode(fake()->randomElements([ 'create_posts', 'edit_posts', 'delete_posts', 'manage_users' ], fake()->numberBetween(1, 3))),
                'is_active' => fake()->boolean(80),
                'is_logged_in' => fake()->randomElement(['info', 'warning', 'error', 'debug']),
            ]);
        }
    }
}
