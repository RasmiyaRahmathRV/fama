<?php

namespace Database\Seeders;

use App\Models\PropertyType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PropertyType::create([
            "property_type_code" => "PTY00001",
            "property_type" => 'Residential',
            'added_by' => 1,
            'created_at' => now()
        ]);
    }
}
