<?php

namespace App\Models;

use App\Models\Traits\HasActivityLog;
use App\Models\Traits\HasDeletedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class ContractRental extends Model
{
    use HasFactory, SoftDeletes, HasActivityLog, HasDeletedBy;

    protected $fillable = [
        'contract_rental_code',
        'contract_id',
        'rent_per_annum_payable',
        'commission_percentage',
        'commission',
        'deposit_percentage',
        'deposit',
        'rent_receivable_per_month',
        'rent_receivable_per_annum',
        'roi_perc',
        'expected_profit',
        'profit_percentage',
        'receivable_start_date',
        'total_payment_to_vendor',
        'total_otc',
        'final_cost',
        'initial_investment',
        'added_by',
        'updated_by',
        'deleted_by',
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function user()
    {
        return $this->belongsTo(
            [User::class, 'added_by', 'id'],
            [User::class, 'updated_by', 'id'],
            [User::class, 'deleted_by', 'id'],
        );
    }

    public function setReceivableStartDateAttribute($value)
    {
        $this->attributes['receivable_start_date'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }
    private function formatNumber($value)
    {
        if ($value === null || $value === '') {
            return null;
        }

        $value = (float) $value;

        if (fmod($value, 1) !== 0.0) {
            return rtrim(rtrim(number_format($value, 2, '.', ','), '0'), '.');
        }

        return number_format((int) $value);
    }


    public function getAttributeValue($key)

    {
        $value = parent::getAttributeValue($key);
        $formatted = [
            'total_payment_to_vendor',
            'total_otc',
            'expected_profit',
            'roi_perc',
            'rent_receivable_per_annum',
            'rent_per_annum_payable',
        ];

        if (in_array($key, $formatted, true)) {
            return $this->formatNumber($value);
        }
        return $value;
    }
}
