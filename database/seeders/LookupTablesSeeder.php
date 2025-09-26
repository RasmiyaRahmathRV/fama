<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LookupTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Countries
        DB::table('property_size_units')->insert([
            ['unit_name' => 'Sq.ft', 'created_at' => now()],
            ['unit_name' => 'Sq.mt', 'created_at' => now()],
        ]);
    }
}
