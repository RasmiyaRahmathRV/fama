<?php

namespace App\Models;

use App\Models\Traits\HasActivityLog;
use App\Models\Traits\HasDeletedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContractOtc extends Model
{
    use HasFactory, SoftDeletes, HasActivityLog, HasDeletedBy;
    protected $table = 'contract_otc';

    protected $fillable = [
        'contract_id',
        'cost_of_developement',
        'cost_of_bed',
        'cost_of_matress',
        'appliances',
        'decoration',
        'dewa_deposit',
        'ejari',
        'cost_of_cabinets',
        'added_by',
        'updated_by',
        'deleted_by'
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function user()
    {
        return $this->belongsTo(
            [User::class, 'added_by', 'id'],
            [User::class, 'updated_by', 'id'],
            [User::class, 'deleted_by', 'id'],
        );
    }
}
