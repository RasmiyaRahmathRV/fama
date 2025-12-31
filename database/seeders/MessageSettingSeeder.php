<?php

namespace Database\Seeders;

use App\Models\MessageSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MessageSetting::create([
            "message_type" => "1",
            "message_body" => "Thank You for Investing with Fama Investment!

                                Hi [Investor Name],
                                We are truly grateful for your trust and confidence in Fama Investment.
                                Your support inspires us to continue delivering exceptional and rewarding opportunities.

                                Together, we’re shaping a future of strong, sustainable growth. 
                                You will get Investment Contract within 2 working days.
                                Should you need any assistance or have questions, we’re always here to help.
                                Welcome to the Fama Investment family!

                                Fama Investment
                                Finance Department
                                https://famainvestment.ae/
                                Mobile No. +971 501932302
                                Land Line. 04 2622177
                                Email. info@famainvestment.com",
        ]);

        MessageSetting::create([
            "message_type" => "2",
            "message_body" => "Your Investment is Growing!

                                Hi [Investor name],
                                You have earned a profit of AED [Profit amount] for the Month of [Month] [Year].

                                Want to boost your growth? Reinvest your returns and watch your wealth soar with Fama Investment!

                                Reply to explore new investment opportunities.
                                Thank you for being part of our success!

                                Fama Investment
                                Finance Department
                                https://famainvestment.ae/
                                Mobile No. +971 501932302
                                Land Line. 04 2622177
                                Email. info@famainvestment.com",
        ]);
    }
}
