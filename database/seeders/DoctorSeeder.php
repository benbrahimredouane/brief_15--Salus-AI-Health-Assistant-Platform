<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            [
                'name' => 'Dr. Yassine Mansouri',
                'specialty' => 'Pediatrics',
                'city' => 'Rabat',
                'yearsofexperience' => 8,
                'consultation_price' => 300,
                'available_days' => 'Mon,Tue,Thu,Fri',
            ],
            [
                'name' => 'Dr. Layla Bensaid',
                'specialty' => 'Dermatology',
                'city' => 'Marrakech',
                'yearsofexperience' => 15,
                'consultation_price' => 350,
                'available_days' => 'Tue,Wed,Sat',
            ],
            [
                'name' => 'Dr. Omar Tazi',
                'specialty' => 'Orthopedics',
                'city' => 'Fes',
                'yearsofexperience' => 20,
                'consultation_price' => 500,
                'available_days' => 'Mon,Wed,Thu',
            ],
            [
                'name' => 'Dr. Sofia Alami',
                'specialty' => 'Neurology',
                'city' => 'Tangier',
                'yearsofexperience' => 6,
                'consultation_price' => 450,
                'available_days' => 'Mon,Fri',
            ],
            [
                'name' => 'Dr. Mehdi Filali',
                'specialty' => 'Ophthalmology',
                'city' => 'Agadir',
                'yearsofexperience' => 10,
                'consultation_price' => 250,
                'available_days' => 'Tue,Wed,Fri,Sat',
            ],
        ];
        DB::table('doctors')->insert($data);
    }
}
