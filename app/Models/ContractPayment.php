<?php

namespace App\Models;

use App\Models\Traits\HasActivityLog;
use App\Models\Traits\HasDeletedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContractPayment extends Model
{
    use HasFactory, SoftDeletes, HasActivityLog, HasDeletedBy;

    protected $fillable = [
        'contract_id',
        'installment_id',
        'interval',
        'beneficiary',
        'added_by',
        'updated_by',
        'deleted_by'
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function installment()
    {
        return $this->belongsTo(Installment::class);
    }

    public function user()
    {
        return $this->belongsTo(
            [User::class, 'added_by', 'id'],
            [User::class, 'updated_by', 'id'],
            [User::class, 'deleted_by', 'id'],
        );
    }
    
    public function contractPaymentDetails()
    {
        return $this->hasMany(ContractPaymentDetail::class);
    }
   
}
