<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class LibMana extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Tạo dữ liệu cho bảng computers
        foreach (range(1, 100) as $index) {
            $computerId = DB::table('computers')->insertGetId([
                'computer_name' => $faker->word . '-' . $faker->randomNumber(3),
                'model' => $faker->word . ' ' . $faker->randomNumber(4),
                'operating_system' => $faker->randomElement(['Windows 10', 'Ubuntu 20.04', 'macOS Monterey']),
                'processor' => $faker->randomElement(['Intel Core i5', 'Intel Core i7', 'AMD Ryzen 5']),
                'memory' => $faker->numberBetween(4, 64), // RAM từ 4GB đến 64GB
                'available' => $faker->boolean,
            ]);

            // Tạo dữ liệu cho bảng issues
            foreach (range(1, 100) as $issueIndex) {
                DB::table('issues')->insert([
                    'computer_id' => $computerId,
                    'reported_by' => $faker->name,
                    'reported_date' => $faker->dateTimeThisYear(),
                    'description' => $faker->paragraph,
                    'urgency' => $faker->randomElement(['Low', 'Medium', 'High']),
                    'status' => $faker->randomElement(['Open', 'In Progress', 'Resolved']),
                ]);
            }
        }
    }
}
