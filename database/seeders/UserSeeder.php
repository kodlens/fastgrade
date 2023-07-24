<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
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
                'username' => 'admin',
                'lname' => 'AMPARADO',
                'fname' => 'ETIENNE WAYNE',
                'mname' => '',
                'suffix' => '',
                'sex' => 'MALE',
                'civil_status' => 'SINGLE',
                'office_id' => 0,
                'contact_no' => '09655138165',
                'role' => 'ADMINISTRATOR',
                'password' => Hash::make('a')
            ],

            [
                'username' => 'ics',
                'lname' => 'CABATINGAN',
                'fname' => 'CARIN',
                'mname' => '',
                'suffix' => '',
                'sex' => 'MALE',
                'civil_status' => 'MARRIED',
                'office_id' => 1,
                'contact_no' => '09655138165',
                'role' => 'DEAN',
                'password' => Hash::make('a')
            ],

            [
                'username' => 'ibfs',
                'lname' => 'TIA',
                'fname' => 'JENNIEFFER',
                'mname' => '',
                'suffix' => '',
                'sex' => 'FEMALE',
                'civil_status' => 'MARRIED',
                'office_id' => 2,
                'contact_no' => '09655138165',
                'role' => 'DEAN',
                'password' => Hash::make('a')
            ],

            [
                'username' => 'janjan',
                'lname' => 'CAGADAS',
                'fname' => 'JOHN MICHAEL',
                'mname' => '',
                'suffix' => '',
                'sex' => 'FEMALE',
                'civil_status' => 'SINGLE',
                'office_id' => 2,
                'contact_no' => '09655138165',
                'role' => 'DEAN',
                'password' => Hash::make('a')
            ],


        ];

        \App\Models\User::insertOrIgnore($data);
    }
}
