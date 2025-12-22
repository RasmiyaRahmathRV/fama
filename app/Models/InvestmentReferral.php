<?php

namespace App\Models;

use App\Models\Traits\HasActivityLog;
use App\Models\Traits\HasDeletedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvestmentReferral extends Model
{
    use HasFactory,  SoftDeletes, HasActivityLog, HasDeletedBy;

    protected $table = 'investment_referrals';

    protected $fillable = [
        'investment_id',
        'investor_id',
        'investor_referror_id',
        'referral_commission_perc',
        'referral_commission_amount',
        'referral_commission_released_amount',
        'referral_commission_pending_amount',
        'referral_commission_frequency_id',
        'referral_commission_status',
        'added_by',
        'updated_by',
        'deleted_by',
    ];

    public function investor()
    {
        return $this->belongsTo(Investor::class, 'investor_id');
    }

    public function referrer()
    {
        return $this->belongsTo(Investor::class, 'investor_referror_id');
    }

    public function commissionFrequency()
    {
        return $this->belongsTo(ReferralCommissionFrequency::class, 'referral_commission_frequency_id');
    }


    public function getPendingAmountAttribute()
    {
        return $this->referral_commission_amount - $this->referral_commission_released_amount;
    }
}
