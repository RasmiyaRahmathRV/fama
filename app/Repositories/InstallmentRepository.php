<?php

namespace App\Repositories;

use App\Models\Installment;
use Illuminate\Contracts\Database\Eloquent\Builder;

class InstallmentRepository
{
    public function all()
    {
        return Installment::all();
    }

    public function find($id)
    {
        return Installment::findOrFail($id);
    }

    public function getByName($installmentData)
    {
        return Installment::where($installmentData)->first();
    }

    public function create($data)
    {
        return Installment::create($data);
    }

    public function updateOrRestore(int $id, array $data)
    {
        $installment = Installment::withTrashed()->findOrFail($id);

        if ($installment->trashed()) {
            $installment->restore();
        }

        $installment->update($data);

        return $installment;
    }

    public function delete($id)
    {
        $installment = $this->find($id);
        return $installment->delete();
    }

    public function checkIfExist($data)
    {
        $existing = Installment::withTrashed()
            ->where('company_id', $data['company_id'])
            ->where('installment_name', $data['installment_name'])
            ->first();

        if ($existing && $existing->trashed()) {
            // $existing->restore();
            return $existing;
        }
    }

    public function getQuery(array $filters = []): Builder
    {
        // print_r($filters);
        $query = Installment::query()
            ->select('installments.*', 'companies.company_name')
            ->join('companies', 'companies.id', '=', 'installments.company_id');

        if (!empty($filters['search'])) {
            $query->orwhere('installment_name', 'like', '%' . $filters['search'] . '%')
                ->orWhere('installment_code', 'like', '%' . $filters['search'] . '%')
                ->orWhereHas('company', function ($q) use ($filters) {
                    $q->where('company_name', 'like', '%' . $filters['search'] . '%');
                })
                ->orWhereRaw("CAST(installments.id AS CHAR) LIKE ?", ['%' . $filters['search'] . '%']);
        }

        if (!empty($filters['company_id'])) {
            $query->Where('installments.company_id', $filters['company_id']);
        }

        return $query;
    }

    public function insertBulk(array $rows)
    {
        return Installment::insert($rows); // bulk insert
    }
}
