<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralCommissionFrequency extends Model
{

    use HasFactory;

    protected $table = 'referral_commission_frequencies';

    protected $fillable = [
        'commission_frequency_name',
        'status',
    ];

    public function investmentReferrals()
    {
        return $this->hasMany(InvestmentReferral::class, 'referral_commission_frequency_id');
    }
}
