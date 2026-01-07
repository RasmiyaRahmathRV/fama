<?php

namespace App\Models;

use App\Models\Traits\HasActivityLog;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractApprovalComment extends Model
{
    use HasFactory, HasActivityLog;

    protected $fillable = [
        'contract_id',
        'user_id',
        'comment'
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }
}
