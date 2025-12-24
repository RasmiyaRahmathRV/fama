<?php

namespace App\Models;

use App\Models\Traits\HasActivityLog;
use App\Models\Traits\HasDeletedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvestmentReceivedPayment extends Model
{
    use HasFactory,  SoftDeletes, HasActivityLog, HasDeletedBy;

    protected $table = 'investment_received_payments';
    protected $fillable = [
        'investment_id',
        'investor_id',
        'is_initial_payment',
        'received_amount',
        'received_date',
        'status',
        'added_by',
        'updated_by',
        'deleted_by',
    ];
    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by', 'id');
    }
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
