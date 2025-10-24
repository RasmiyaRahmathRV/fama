<?php

namespace App\Models;

use App\Models\Traits\HasActivityLog;
use App\Models\Traits\HasDeletedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgreementPaymentDetail extends Model
{
    use HasFactory, SoftDeletes, HasActivityLog, HasDeletedBy;

    protected $table = 'agreement_payment_details';

    protected $fillable = [
        'agreement_id',
        'agreement_payment_id',
        'payment_mode_id',
        'bank_id',
        'cheque_number',
        'cheque_issuer',
        'cheque_issuer_name',
        'cheque_issuer_id',
        'payment_date',
        'payment_amount',
        'is_payment_received',
        'paid_amount',
        'pending_amount',
        'paid_date',
        'added_by',
        'updated_by',
        'deleted_by',
    ];

    /**
     * Relationships
     */

    public function agreement()
    {
        return $this->belongsTo(Agreement::class);
    }

    public function agreementPayment()
    {
        return $this->belongsTo(AgreementPayment::class);
    }

    public function paymentMode()
    {
        return $this->belongsTo(PaymentMode::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
}
