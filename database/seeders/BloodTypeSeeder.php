<?php

namespace Database\Seeders;

use App\Models\BloodType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BloodTypeSeeder extends Seeder
{
    private $bloodTypes = [
        'O+',
        'O-',
        'A+',
        'A-',
        'B+',
        'B-',
        'AB+',
        'AB-',
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->bloodTypes as $bloodType) {
            BloodType::create(['name' => $bloodType]);
        }
    }
}
