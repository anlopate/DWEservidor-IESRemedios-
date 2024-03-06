<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;



class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Añadir varios cursos
        DB::table('courses')->insert(
            [
                'course' => Str::random(20),
                'ciclo' => Str::random(15) . 'FP',
            ]);
            DB::table('courses')->insert(
            [
                'course' => Str::random(20),
                'ciclo' => Str::random(15) . 'FP',
            ]);
            
            DB::table('courses')->insert(
            [
                'course' => '1AD',
                'ciclo' => 'Asistencia dirección'
            ]);
            DB::table('courses')->insert(
                [
                    'course' => '1AD',
                    'ciclo' => 'Asistencia dirección'
                ]);
            
        }
    
    }