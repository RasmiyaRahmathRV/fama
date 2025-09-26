<?php

namespace App\Services;

use App\Models\Area;
use App\Models\ImportBatch;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Services\CompanyService;
use Illuminate\Validation\Rule;

class AreaImportService
{
    protected CompanyService $companyService;


    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    /**
     * Process and save imported rows
     */
    public function save(Collection $rows, int $user_id, int $batch_id): void
    {
        $batch = ImportBatch::find($batch_id);
        $batch->update(['status' => 'processing']);

        $data = [];
        $errors = [];
        $duplicate = [];
        foreach ($rows as $index => $row) {
            // Get or create company
            $company_id = $this->companyService->getIdByCompanyname($row[0]);


            // Basic validation
            $validator = Validator::make([
                'area_name' => $row[1] ?? null,
            ], [
                'areas_company_id_area_name_unique' => 'required|string|unique:areas,areas_company_id_area_name_unique,NULL,id',
            ]);

            if ($validator->fails()) {
                $errors[] = [
                    'row' => $index + 1,
                    'error' => $validator->errors()->toArray(),
                ];
                continue;
            }


            if (!$company_id) {
                $codeService = new \App\Services\CodeGeneratorService();
                $company_code = $codeService->generateNextCode('companies', 'company_code', 'CMP', 5, $index + 1);

                $company_id = $this->companyService->create([
                    'company_code' => $company_code,
                    'company_name' => $row[0],
                    'added_by' => $user_id,
                ], $user_id)->id;
            }


            if (Area::existsForCompany($row[1], $company_id)) {
                $duplicate[] = $row;
            } else {
                $data[] = [
                    'company_id' => $company_id,
                    'area_name' => $row[1],
                    'area_code' => $row[2],
                    'added_by' => $user_id,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }

        // Bulk insert
        if (!empty($data)) {
            Area::insert($data);
        }

        // Update processed rows
        $batch->increment('processed_rows', count($rows));

        // duplicates errors
        if (!empty($duplicate)) {
            Log::error('Duplicate entries:', $duplicate);
        }

        // Log errors
        if (!empty($errors)) {
            Log::error('Area Import Errors', $errors);
        }
    }
}
