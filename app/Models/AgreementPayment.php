<?php

namespace App\Models;

use App\Models\Traits\HasActivityLog;
use App\Models\Traits\HasDeletedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgreementPayment extends Model
{
    use HasFactory, SoftDeletes, HasActivityLog, HasDeletedBy;

    protected $table = 'agreement_payments';

    protected $fillable = [
        'agreement_id',
        'installment_id',
        'interval',
        'beneficiary',
        'total_rent_annum',
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

    public function installment()
    {
        return $this->belongsTo(Installment::class);
    }

    public function agreementPaymentDetails()
    {
        return $this->hasMany(AgreementPaymentDetail::class);
    }
}
