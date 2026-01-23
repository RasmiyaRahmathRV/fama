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

    public function __construct(
        protected $search = null,
        protected $filter = null,
    ) {}

    public function collection()
    {
        $query = Installment::with('company');

        if ($this->search) {
            $search = $this->search;
            $query->where(function ($q) use ($search) {
                $q->where('installment_name', 'like', "%{$search}%")
                    ->orWhere('installment_code', 'like', "%{$search}%")
                    ->orWhere('interval', 'like', "%{$search}%")
                    ->orWhereHas('company', function ($q2) use ($search) {
                        $q2->where('company_name', 'like', "%{$search}%");
                    })
                    ->orWhereRaw("CAST(installments.id AS CHAR) LIKE ?", ["%{$search}%"]);
            });
        }

        if ($this->filter) {
            $query->where('company_id', $this->filter);
        }

        return $query->get()
            ->map(function ($installment) {
                return [
                    'ID' => $installment->id,
                    'Installment Code' => $installment->installment_code,
                    // 'Company' => $installment->company->company_name ?? '',
                    'Installment Name' => $installment->installment_name,
                    'Interval'    => $installment->interval,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Installment Code',
            // 'Company',
            'Installment Name',
            'Interval',
        ];
    }
}
