<?php

namespace App\Exports;

use App\Models\PaymentMode;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PaymentModeExport implements FromCollection, WithHeadings
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
        $query = PaymentMode::with('company');

        if ($this->search) {
            $search = $this->search;
            $query->where(function ($q) use ($search) {
                $q->where('payment_mode_name', 'like', "%{$search}%")
                    ->orWhere('payment_mode_code', 'like', "%{$search}%")
                    ->orWhere('payment_mode_short_code', 'like', "%{$search}%")
                    ->orWhereHas('company', function ($q2) use ($search) {
                        $q2->where('company_name', 'like', "%{$search}%");
                    })
                    ->orWhereRaw("CAST(pament_modes.id AS CHAR) LIKE ?", ["%{$search}%"]);
            });
        }


        return $query->get()
            ->map(function ($paymentMode) {
                return [
                    'ID' => $paymentMode->id,
                    'Payment Mode Code' => $paymentMode->payment_mode_code,
                    'Company' => $paymentMode->company->company_name ?? '',
                    'Payment Mode Name' => $paymentMode->payment_mode_name,
                    'Payment Mode Short Code' => $paymentMode->payment_mode_short_code,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Payment Mode Code',
            'Company',
            'Payment Mode Name',
            'Payment Mode Short Code'
        ];
    }
}
