<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB:table('students')->insert(
            [
                ['name' => 'Ana',
                'surname' => 'Lopez Atero',
                'birth-date' => '2000/05/12',
                'phone' => '956874512',
                'city' => 'Cádiz',
                'dni' => '78451296O',
                'email' => 'ana@gmail.com',
                'course_id' => 1
                ],
               
            ]

        );    }
}
