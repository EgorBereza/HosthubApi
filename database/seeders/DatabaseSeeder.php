<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        DB::table('rentals')->insert([
            ['name' => 'Villa A', 'type' => 'standalone_rental', 'parent_rental' => 1],
            ['name' => 'Villa B', 'type' => 'standalone_rental', 'parent_rental' => 2],

            ['name' => 'Room 101', 'type' => 'room', 'parent_rental' => null],
            ['name' => 'Room 102', 'type' => 'room', 'parent_rental' => null],
            ['name' => 'Room 103', 'type' => 'room', 'parent_rental' => null],
            ['name' => 'Room 104', 'type' => 'room', 'parent_rental' => null],
            ['name' => 'Room 105', 'type' => 'room', 'parent_rental' => null],
            ['name' => 'Room 106', 'type' => 'room', 'parent_rental' => null],


            ['name' => 'Grand Suite', 'type' => 'room_type', 'parent_rental' => 3],
            ['name' => 'Double Bed Room', 'type' => 'room_type', 'parent_rental' => 4],
            ['name' => 'Grand Suite', 'type' => 'room_type', 'parent_rental' =>5],
            ['name' => 'Double Bed Room', 'type' => 'room_type', 'parent_rental' => 6],
            ['name' => 'Grand Suite', 'type' => 'room_type', 'parent_rental' => 7],
            ['name' => 'Double Bed Room', 'type' => 'room_type', 'parent_rental' => 8],
        ]);


        DB::table('bookings')->insert([
             ['parent_rental' => 1, 'rental' => 1, 'check_in_date' => '2024-06-22', 'check_out_date' => '2024-06-25'],
             ['parent_rental' => 2, 'rental' => 2, 'check_in_date' => '2024-06-24', 'check_out_date' => '2024-06-27'],

             ['parent_rental' => 3, 'rental' => 9, 'check_in_date' => '2024-07-01', 'check_out_date' => '2024-07-10'],
             ['parent_rental' => 4, 'rental' => 10, 'check_in_date' => '2024-07-05', 'check_out_date' => '2024-07-08'],

             ['parent_rental' => 5, 'rental' => 11, 'check_in_date' => '2024-07-10', 'check_out_date' => '2024-07-15'],
             ['parent_rental' => 6, 'rental' => 12, 'check_in_date' => '2024-07-12', 'check_out_date' => '2024-07-17'],
        ]);

    }
}