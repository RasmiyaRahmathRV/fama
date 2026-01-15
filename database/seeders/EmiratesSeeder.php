<?php

namespace Database\Seeders;

use App\Models\Emirate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmiratesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $emirates = [
            ['name' => 'Abu Dhabi'],
            ['name' => 'Dubai'],
            ['name' => 'Sharjah'],
            ['name' => 'Ajman'],
            ['name' => 'Umm Al Quwain'],
            ['name' => 'Ras Al Khaimah'],
            ['name' => 'Fujairah'],
        ];

        foreach ($emirates as $emirate) {
            Emirate::updateOrCreate(
                ['name' => $emirate['name']],
            );
        }
    }
}
