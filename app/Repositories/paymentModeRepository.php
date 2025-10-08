<?php

namespace App\Repositories;

use App\Models\PaymentMode;
use Illuminate\Contracts\Database\Eloquent\Builder;

class PaymentModeRepository
{
    public function all()
    {
        return PaymentMode::all();
    }

    public function find($id)
    {
        return PaymentMode::findOrFail($id);
    }

    public function getByName($bankData)
    {
        return PaymentMode::where($bankData)->first();
    }

    public function create($data)
    {
        return PaymentMode::create($data);
    }

    public function updateOrRestore(int $id, array $data)
    {
        $bank = PaymentMode::withTrashed()->findOrFail($id);

        if ($bank->trashed()) {
            $bank->restore();
        }

        $bank->update($data);

        return $bank;
    }

    public function delete($id)
    {
        $bank = $this->find($id);
        return $bank->delete();
    }

    public function checkIfExist($data)
    {
        $existing = PaymentMode::withTrashed()
            ->where('company_id', $data['company_id'])
            ->where('payment_mode_name', $data['payment_mode_name'])
            ->first();

        if ($existing && $existing->trashed()) {
            // $existing->restore();
            return $existing;
        }
    }

    public function getQuery(array $filters = []): Builder
    {
        // print_r($filters);
        $query = PaymentMode::query()
            ->select('payment_modes.*', 'companies.company_name')
            ->join('companies', 'companies.id', '=', 'payment_modes.company_id');

        if (!empty($filters['search'])) {
            $query->orwhere('payment_mode_name', 'like', '%' . $filters['search'] . '%')
                ->orWhere('payment_mode_code', 'like', '%' . $filters['search'] . '%')
                ->orWhere('payment_mode_short_code', 'like', '%' . $filters['search'] . '%')
                ->orWhereHas('company', function ($q) use ($filters) {
                    $q->where('company_name', 'like', '%' . $filters['search'] . '%');
                })
                ->orWhereRaw("CAST(payment_modes.id AS CHAR) LIKE ?", ['%' . $filters['search'] . '%']);
        }

        if (!empty($filters['company_id'])) {
            $query->Where('payment_modes.company_id', $filters['company_id']);
        }

        return $query;
    }

    public function insertBulk(array $rows)
    {
        return PaymentMode::insert($rows); // bulk insert
    }
}
