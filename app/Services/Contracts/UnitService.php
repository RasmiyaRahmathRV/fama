<?php

namespace App\Services\Contracts;

use App\Models\UnitType;
use App\Repositories\Contracts\UnitRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UnitService
{
    public function __construct(
        protected UnitRepository $unitRepo,
    ) {}

    public function getAll()
    {
        return $this->unitRepo->all();
    }

    public function getById($id)
    {
        return $this->unitRepo->find($id);
    }

    public function create($contract_id, array $data, array $unitdetails, $user_id = null)
    {
        $this->validate($data);
        $data['contract_id'] = $contract_id;
        $data['added_by'] = $user_id ? $user_id : auth()->user()->id;
        $data['contract_unit_code'] = $this->setUnitCode();

        $data = array_merge($data, $this->getUnitSummary($unitdetails));

        return $this->unitRepo->create($data);
    }

    public function setUnitCode($addval = 1)
    {
        $codeService = new \App\Services\CodeGeneratorService();
        return $codeService->generateNextCode('contract_units', 'contract_unit_code', 'VCU', 5, $addval);
    }

    public function getUnitSummary(array $unitDetails)
    {
        $unitNumbers = implode(', ', array_filter($unitDetails['unit_number'] ?? []));

        $unitTypeCounts = array_count_values(array_filter($unitDetails['unit_type_id'] ?? []));

        $lookupNames = UnitType::getNamesByIds(array_keys($unitTypeCounts));

        $unitTypeSummary = [];
        foreach ($unitTypeCounts as $typeId => $count) {
            $typeName = $lookupNames[$typeId] ?? 'Unknown';
            $unitTypeSummary[] = "{$count} ({$typeName})";
        }

        $unitTypeSummaryText = implode(', ', $unitTypeSummary);

        return [
            'unit_numbers' => $unitNumbers,
            'unit_type_count'   => $unitTypeSummaryText,
        ];
    }

    private function validate(array $data, $id = null)
    {
        $validator = Validator::make($data, [
            // 'nationality_name' => [
            //     'required',
            //     Rule::unique('nationalities')->ignore($id)
            //         ->where(fn($q) => $q
            //             // ->where('company_id', $data['company_id'])
            //             ->whereNull('deleted_at'))
            // ],
            // 'nationality_short_code' => 'required',
            // 'company_id' => 'required|exists:companies,id',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
