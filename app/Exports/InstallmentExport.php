<?php

namespace App\Exports;

use App\Models\Installment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InstallmentExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $search;

    public function __construct($search = null)
    {
        $this->search = $search;
    }

    public function collection()
    {
        $query = Installment::with('company');

        if ($this->search) {
            $search = $this->search;
            $query->where(function ($q) use ($search) {
                $q->where('installment_name', 'like', "%{$search}%")
                    ->orWhere('installment_code', 'like', "%{$search}%")
                    ->orWhereHas('company', function ($q2) use ($search) {
                        $q2->where('company_name', 'like', "%{$search}%");
                    })
                    ->orWhereRaw("CAST(installments.id AS CHAR) LIKE ?", ["%{$search}%"]);
            });
        }


        return $query->get()
            ->map(function ($installment) {
                return [
                    'ID' => $installment->id,
                    'Installment Code' => $installment->installment_code,
                    'Company' => $installment->company->company_name ?? '',
                    'Installment Name' => $installment->installment_name,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Installment Code',
            'Company',
            'Installment Name',
        ];
    }
}
