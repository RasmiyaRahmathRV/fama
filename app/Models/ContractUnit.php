<?php

namespace App\Models;

use App\Models\Traits\HasActivityLog;
use App\Models\Traits\HasDeletedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContractUnit extends Model
{
    use HasFactory, SoftDeletes, HasActivityLog, HasDeletedBy;

    protected $fillable = [
        'contract_unit_code',
        'contract_id',
        'building_type',
        'business_type',
        'no_of_units',
        'unit_numbers',
        'unit_type_count',
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
    public function contractUnitDetails()
    {
        return $this->hasMany(ContractUnitDetail::class);
    }
    public function business_type()
    {
        return $this->business_type == 1 ? 'B2B' : 'B2C';
    }
}
