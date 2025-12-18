<?php

namespace App\Models;

use App\Models\Traits\HasActivityLog;
use App\Models\Traits\HasDeletedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvestorPayout extends Model
{
    use HasFactory, SoftDeletes, HasActivityLog, HasDeletedBy;

    protected $fillable = [
        'investor_id',
        'investment_id',
        'total_payout_amount',
        'type_of_payout',
        'total_payout_date',
        'payout_by',
        'remarks',
    ];

    public function investor()
    {
        return $this->belongsTo(Investor::class);
    }
}
