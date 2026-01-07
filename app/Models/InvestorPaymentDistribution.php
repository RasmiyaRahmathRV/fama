<?php

namespace App\Models;

use App\Models\Traits\HasActivityLog;
use App\Models\Traits\HasDeletedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvestorPaymentDistribution extends Model
{
    use HasFactory,  SoftDeletes, HasActivityLog, HasDeletedBy;

    protected $fillable = [
        'investor_id',
        'payout_id',
        'amount_paid',
        'paid_by',
        'paid_date',
        'updated_by',
        'deleted_by',
    ];
}
