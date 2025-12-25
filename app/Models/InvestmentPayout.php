<?php

namespace App\Models;

use App\Models\Traits\HasActivityLog;
use App\Models\Traits\HasDeletedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvestmentPayout extends Model
{
    use HasFactory,  SoftDeletes, HasActivityLog, HasDeletedBy;

    protected $table = 'investment_payouts';

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'investment_id',
        'investor_id',
        'investment_referral_id',
        'payout_type',
        'payout_release_month',
        'payout_amount',
        'amount_paid',
        'amount_pending',
        'updated_by',
        'deleted_by',


    ];
}
