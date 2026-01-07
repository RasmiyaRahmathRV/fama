<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TenantIdentity;

class TenantIdentitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TenantIdentity::create([
            'identity_type' => 'Passport',
            'first_field_name' => 'passport_number',
            'first_field_id' => 'passport_number',
            'first_field_type' => 'text',
            'first_field_label' => 'Passport Number',
            'second_field_name' => 'passport_copy',
            'second_field_id' => 'passport_copy',
            'second_field_type' => 'file',
            'second_field_label' => 'Passport Copy Upload',
            'show_status' => true,
        ]);

        TenantIdentity::create([
            'identity_type' => 'Emirates ID',
            'first_field_name' => 'emirates_id_number',
            'first_field_id' => 'emirates_id_number',
            'first_field_type' => 'text',
            'first_field_label' => 'Emirates ID Number',
            'second_field_name' => 'emirates_id_copy',
            'second_field_id' => 'emirates_id_copy',
            'second_field_type' => 'file',
            'second_field_label' => 'Emirates ID Copy Upload',
            'show_status' => true,
        ]);

        TenantIdentity::create([
            'identity_type' => 'Trade License',
            'first_field_name' => 'trade_license_no',
            'first_field_id' => 'trade_license_no',
            'first_field_type' => 'text',
            'first_field_label' => 'Trade License Number',
            'second_field_name' => 'trade_license_copy',
            'second_field_id' => 'trade_license_copy',
            'second_field_type' => 'file',
            'second_field_label' => 'Trade License Copy Upload',
            'show_status' => true,
        ]);

        TenantIdentity::create([
            'identity_type' => 'Visa',
            'first_field_name' => 'visa_number',
            'first_field_id' => 'visa_number',
            'first_field_type' => 'text',
            'first_field_label' => 'Visa UID Number',
            'second_field_name' => 'visa_copy',
            'second_field_id' => 'visa_copy',
            'second_field_type' => 'file',
            'second_field_label' => 'Visa Copy Upload',
            'show_status' => true,
        ]);
        TenantIdentity::create([
            'identity_type' => 'Agreement',
            'first_field_name' => 'agreement_number',
            'first_field_id' => 'agreement_number',
            'first_field_type' => 'text',
            'first_field_label' => 'Agreement Number',
            'second_field_name' => 'agreement_copy',
            'second_field_id' => 'agreement_copy',
            'second_field_type' => 'file',
            'second_field_label' => 'Signed Agreement Upload',
            'show_status' => false,
        ]);
        TenantIdentity::create([
            'identity_type' => 'Tenant Contract',
            // 'first_field_name' => 'agreement_number',
            // 'first_field_id' => 'agreement_number',
            // 'first_field_type' => 'text',
            // 'first_field_label' => 'Agreement Number',
            'second_field_name' => 'contract_copy',
            'second_field_id' => 'contract_copy',
            'second_field_type' => 'file',
            'second_field_label' => 'Upload Tenant Contract',
            'show_status' => false,
        ]);
    }
}
