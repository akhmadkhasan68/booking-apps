<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Facility::create([
            'name' => 'Proyektor',
        ]);
        
        Facility::create([
            'name' => 'Kamar Mandi',
        ]);
        
        Facility::create([
            'name' => 'Papan Tulis',
        ]);
        
        Facility::create([
            'name' => 'Kursi',
        ]);
    }
}
