<?php

namespace App\Repositories;

use App\Models\Vendor;
use Illuminate\Contracts\Database\Eloquent\Builder;

class VendorRepository
{
    public function all()
    {
        // return Vendor::all();
        return Vendor::where('status', 1)->get();
    }

    public function find($id)
    {
        return Vendor::findOrFail($id);
    }

    public function getByName($vendorData)
    {
        return Vendor::where($vendorData)->first();
    }

    public function create($data)
    {
        return Vendor::create($data);
    }

    public function updateOrRestore(int $id, array $data)
    {
        $vendor = Vendor::withTrashed()->findOrFail($id);

        if ($vendor->trashed()) {
            $vendor->restore();
        }

        $vendor->update($data);

        return $vendor;
    }

    public function delete($id)
    {
        $vendor = $this->find($id);
        return $vendor->delete();
    }

    public function checkIfExist($data)
    {
        $existing = Vendor::withTrashed()
            // ->where('company_id', $data['company_id'])
            ->where('vendor_name', $data['vendor_name'])
            ->first();

        // if ($existing && $existing->trashed()) {
        //     // $existing->restore();
        //     return $existing;
        // }
        return $existing;
    }

    public function getQuery(array $filters = []): Builder
    {
        // print_r($filters);
        $query = Vendor::query()
            ->select('vendors.*');
        // ->join('companies', 'companies.id', '=', 'vendors.company_id');

        if (!empty($filters['search'])) {
            $query->orwhere('vendor_name', 'like', '%' . $filters['search'] . '%')
                ->orWhere('vendor_code', 'like', '%' . $filters['search'] . '%')
                ->orWhere('vendor_phone', 'like', '%' . $filters['search'] . '%')
                ->orWhere('vendor_email', 'like', '%' . $filters['search'] . '%')
                ->orWhere('vendor_address', 'like', '%' . $filters['search'] . '%')
                ->orWhere('accountant_name', 'like', '%' . $filters['search'] . '%')
                ->orWhere('accountant_phone', 'like', '%' . $filters['search'] . '%')
                ->orWhere('accountant_email', 'like', '%' . $filters['search'] . '%')
                ->orWhere('contact_person', 'like', '%' . $filters['search'] . '%')
                ->orWhere('contact_person_email', 'like', '%' . $filters['search'] . '%')
                ->orWhere('contact_person_phone', 'like', '%' . $filters['search'] . '%')
                // ->orWhereHas('company', function ($q) use ($filters) {
                //     $q->where('company_name', 'like', '%' . $filters['search'] . '%');
                // })
                ->orWhereRaw("CAST(vendors.id AS CHAR) LIKE ?", ['%' . $filters['search'] . '%']);
        }

        // if (!empty($filters['company_id'])) {
        //     $query->Where('vendors.company_id', $filters['company_id']);
        // }

        return $query;
    }

    public function insertBulk(array $rows)
    {
        return Vendor::insert($rows); // bulk insert
    }
}
