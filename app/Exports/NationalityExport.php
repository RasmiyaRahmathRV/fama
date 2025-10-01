<?php

namespace App\Exports;

use App\Models\Nationality;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class NationalityExport implements FromCollection, WithHeadings
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
        $query = Nationality::with('company');

        if ($this->search) {
            $search = $this->search;
            $query->where(function ($q) use ($search) {
                $q->where('nationality_name', 'like', "%{$search}%")
                    ->orWhere('nationality_code', 'like', "%{$search}%")
                    ->orWhere('nationality_short_code', 'like', "%{$search}%")
                    ->orWhereHas('company', function ($q2) use ($search) {
                        $q2->where('company_name', 'like', "%{$search}%");
                    })
                    ->orWhereRaw("CAST(nationalities.id AS CHAR) LIKE ?", ["%{$search}%"]);
            });
        }


        return $query->get()
            ->map(function ($nationality) {
                return [
                    'ID' => $nationality->id,
                    'Nationality Code' => $nationality->nationality_code,
                    'Company' => $nationality->company->company_name ?? '',
                    'Nationality Name' => $nationality->nationality_name,
                    'Nationality Short Code' => $nationality->nationality_short_code,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nationality Code',
            'Company',
            'Nationality Name',
            'Nationality Short Code'
        ];
    }
}
