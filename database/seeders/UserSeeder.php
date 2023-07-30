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
                'role' => 'STUDENT',
                'password' => Hash::make('a')
            ],
            [
                'username' => 'leda',
                'lname' => 'ABELLA',
                'fname' => 'LEDA GRACE',
                'mname' => '',
                'suffix' => '',
                'sex' => 'FEMALE',
                'civil_status' => 'SINGLE',
                'office_id' => 2,
                'contact_no' => '09655138165',
                'role' => 'FACULTY',
                'password' => Hash::make('a')
            ],
            [
                'username' => 'junrey',
                'lname' => 'SANTARITA',
                'fname' => 'JUNREY',
                'mname' => '',
                'suffix' => '',
                'sex' => 'MALE',
                'civil_status' => 'SINGLE',
                'office_id' => 2,
                'contact_no' => '09655138165',
                'role' => 'FACULTY',
                'password' => Hash::make('a')
            ],
            [
                'username' => 'etet',
                'lname' => 'AMPARADO',
                'fname' => 'ETIENNE WAYNE',
                'mname' => '',
                'suffix' => '',
                'sex' => 'MALE',
                'civil_status' => 'SINGLE',
                'office_id' => 2,
                'contact_no' => '09655138165',
                'role' => 'FACULTY',
                'password' => Hash::make('a')
            ],
            [
                'username' => 'makmak',
                'lname' => 'BASAYA',
                'fname' => 'MC GYVER',
                'mname' => '',
                'suffix' => '',
                'sex' => 'MALE',
                'civil_status' => 'SINGLE',
                'office_id' => 2,
                'contact_no' => '09655138165',
                'role' => 'FACULTY',
                'password' => Hash::make('a')
            ],


            [
                'username' => 'nimchie',
                'lname' => 'HIBAYA',
                'fname' => 'NIMCHIE',
                'mname' => '',
                'suffix' => '',
                'sex' => 'FEMALE',
                'civil_status' => 'SINGLE',
                'office_id' => 0,
                'contact_no' => '09655138165',
                'role' => 'STUDENT',
                'password' => Hash::make('a')
            ],
            [
                'username' => 'itching',
                'lname' => 'MAGLANGIT',
                'fname' => 'RICHIE',
                'mname' => '',
                'suffix' => '',
                'sex' => 'MALE',
                'civil_status' => 'SINGLE',
                'office_id' => 0,
                'contact_no' => '09655138165',
                'role' => 'STUDENT',
                'password' => Hash::make('a')
            ],
            [
                'username' => 'haziel',
                'lname' => 'ALGADIPE',
                'fname' => 'HAZIEL',
                'mname' => '',
                'suffix' => '',
                'sex' => 'FEMALE',
                'civil_status' => 'SINGLE',
                'office_id' => 0,
                'contact_no' => '09655138165',
                'role' => 'STUDENT',
                'password' => Hash::make('a')
            ],
            [
                'username' => 'jesa',
                'lname' => 'BECHAYDA',
                'fname' => 'JESA',
                'mname' => '',
                'suffix' => '',
                'sex' => 'FEMALE',
                'civil_status' => 'SINGLE',
                'office_id' => 0,
                'contact_no' => '09655138165',
                'role' => 'STUDENT',
                'password' => Hash::make('a')
            ],
            [
                'username' => 'marjhon',
                'lname' => 'PUCOT',
                'fname' => 'MARJHON',
                'mname' => '',
                'suffix' => '',
                'sex' => 'MALE',
                'civil_status' => 'SINGLE',
                'office_id' => 0,
                'contact_no' => '09655138165',
                'role' => 'STUDENT',
                'password' => Hash::make('a')
            ],
            [
                'username' => 'roger',
                'lname' => 'LACAPAG',
                'fname' => 'ROGER',
                'mname' => '',
                'suffix' => '',
                'sex' => 'MALE',
                'civil_status' => 'SINGLE',
                'office_id' => 0,
                'contact_no' => '09655138165',
                'role' => 'STUDENT',
                'password' => Hash::make('a')
            ],
            [
                'username' => 'charles',
                'lname' => 'VARGAS',
                'fname' => 'charles',
                'mname' => '',
                'suffix' => '',
                'sex' => 'MALE',
                'civil_status' => 'SINGLE',
                'office_id' => 0,
                'contact_no' => '09655138165',
                'role' => 'STUDENT',
                'password' => Hash::make('a')
            ],


        ];

        \App\Models\User::insertOrIgnore($data);
    }
}
