<?php

namespace App\Models;

use App\Models\Traits\HasActivityLog;
use App\Models\Traits\HasDeletedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class ContractPaymentDetail extends Model
{
    use HasFactory, SoftDeletes, HasActivityLog, HasDeletedBy;

    protected $fillable = [
        'contract_id',
        'contract_payment_id',
        'payment_mode_id',
        'payment_date',
        'payment_amount',
        'bank_id',
        'cheque_no',
        'cheque_issuer',
        'cheque_issuer_name',
        'cheque_issuer_id',
        'added_by',
        'updated_by',
        'deleted_by',
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function contract_payment()
    {
        return $this->belongsTo(ContractPayment::class);
    }

    public function payment_mode()
    {
        return $this->belongsTo(PaymentMode::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function user()
    {
        return $this->belongsTo(
            [User::class, 'added_by', 'id'],
            [User::class, 'updated_by', 'id'],
            [User::class, 'deleted_by', 'id'],
        );
    }

    public function setPaymentDateAttribute($value)
    {
        $this->attributes['payment_date'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }
}
