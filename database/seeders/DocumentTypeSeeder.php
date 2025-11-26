<?php

namespace Database\Seeders;

use App\Models\DocumentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $documentTypes = [
            [
                // 'document_type' => 1,
                'label_name' => 'Vendor Contract',
                'field_type' => 'file',
                'field_name' => 'vendor_contract',
                'status_change_value' => 'is_vendor_contract_uploaded',
                'accept_types' => '.pdf,image/*',
                'status' => 1,
            ],
            [
                // 'document_type' => 2,
                'label_name' => 'Upload Cheque copy',
                'field_type' => 'file',
                'field_name' => 'cheque_copy',
                'status_change_value' => 'is_cheque_copy_uploaded',
                'accept_types' => '.pdf,image/*',
                'status' => 1,
            ],
            [
                // 'document_type' => 3,
                'label_name' => 'Acknoledgement',
                'field_type' => 'file',
                'field_name' => 'acknoledgement',
                'status_change_value' => 'is_aknowledgement_uploaded',
                'accept_types' => '.pdf,image/*',
                'status' => 1,
            ],
        ];

        foreach ($documentTypes as $type) {
            DocumentType::create($type);
        }
    }
}
