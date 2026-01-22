<?php

namespace App\Exports;

use App\Models\Vendor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VendorExport implements FromCollection, WithHeadings
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
        // $query = Vendor::with('company');
        $query = Vendor::query();

        if ($this->search) {
            $search = $this->search;
            $query->where(function ($q) use ($search) {
                $q->where('vendor_name', 'like', "%{$search}%")
                    ->orWhere('vendor_code', 'like', "%{$search}%")
                    ->orWhere('vendor_phone', 'like', "%{$search}%")
                    ->orWhere('vendor_email', 'like', "%{$search}%")
                    ->orWhere('vendor_address', 'like', "%{$search}%")
                    ->orWhere('accountant_name', 'like', "%{$search}%")
                    ->orWhere('accountant_phone', 'like', "%{$search}%")
                    ->orWhere('accountant_email', 'like', "%{$search}%")
                    ->orWhere('contact_person', 'like', "%{$search}%")
                    ->orWhere('contact_person_email', 'like', "%{$search}%")
                    ->orWhere('contact_person_phone', 'like', "%{$search}%")
                    // ->orWhereHas('company', function ($q2) use ($search) {
                    //     $q2->where('company_name', 'like', "%{$search}%");
                    // })
                    ->orWhereRaw("CAST(vendors.id AS CHAR) LIKE ?", ["%{$search}%"]);
            });
        }

        // if ($this->filter) {
        //     $query->where('company_id', $this->filter);
        // }


        return $query->get()
            ->map(function ($vendor) {
                return [
                    'ID' => $vendor->id,
                    'Vendor Code' => $vendor->vendor_code,
                    // 'Company' => $vendor->company->company_name ?? '',
                    'Vendor Name' => $vendor->vendor_name,
                    'Vendor Phone' => $vendor->vendor_phone,
                    'Vendor Email' => $vendor->vendor_email,
                    'Landline Number' => $vendor->landline_number,
                    'Vendor Address' => $vendor->vendor_address,
                    'Accountant Name' => $vendor->accountant_name,
                    'Accountant Phone' => $vendor->accountant_phone,
                    'Accountant Email' => $vendor->accountant_email,
                    'Contact Person' => $vendor->contact_person,
                    'Contact Person Phone' => $vendor->contact_person_phone,
                    'Contact Person Email' => $vendor->contact_person_email,
                    'status' => ($vendor->status ?? 1) == 1 ? 'Active' : 'Inactive',
                    // 'C' => $vendor->contact_person_email,
                    // 'Contact Person Email' => $vendor->contact_person_email,
                    // 'Contact Person Email' => $vendor->contact_person_email,


                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Vendor Code',
            // 'Company',
            'Vendor Name',
            'Vendor Phone',
            'Vendor Email',
            'Landline Number',
            'Vendor Address',
            'Accountant Name',
            'Accountant Phone',
            'Accountant Email',
            'Contact Person',
            'Contact Person Phone',
            'Contact Person Email',
            'Status'
        ];
    }
}
