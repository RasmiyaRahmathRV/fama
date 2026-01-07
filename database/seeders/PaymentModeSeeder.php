<?php

namespace Database\Seeders;

use App\Models\PaymentMode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentModeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        PaymentMode::create([
            "payment_mode_code" => "PMD00001",
            "payment_mode_name" => "Cash",
            "payment_mode_short_code" => "CASH",
            "added_by" => 1,
            "status" => 1
        ]);
        PaymentMode::create([
            "payment_mode_code" => "PMD00002",
            "payment_mode_name" => "Bank Transfer",
            "payment_mode_short_code" => "BNK",
            "added_by" => 1,
            "status" => 1
        ]);
        PaymentMode::create([
            "payment_mode_code" => "PMD00003",
            "payment_mode_name" => "Cheque",
            "payment_mode_short_code" => "CHQ",
            "added_by" => 1,
            "status" => 1
        ]);
        PaymentMode::create([
            "payment_mode_code" => "PMD00004",
            "payment_mode_name" => "Credit Card",
            "payment_mode_short_code" => "CC",
            "added_by" => 1,
            "status" => 1
        ]);
    }
}
