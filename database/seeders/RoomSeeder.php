<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            [
                'room' => 'MB 201',
                'room_desc' => 'LECTURE ROOM',
                'max' => 40,
            ],
            [
                'room' => 'MB 202',
                'room_desc' => 'LECTURE ROOM',
                'max' => 40,
            ],
            [
                'room' => 'CLAB 101',
                'room_desc' => 'COMPUTER LABORATORY 1',
                'max' => 40,
            ],
            [
                'room' => 'CLAB 102',
                'room_desc' => 'COMPUTER LABORATORY 2',
                'max' => 40,
            ],


        ];

        \App\Models\Room::insertOrIgnore($data);
    }
}
