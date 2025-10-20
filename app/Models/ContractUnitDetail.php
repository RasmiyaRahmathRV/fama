<?php

namespace App\Models;

use App\Models\Traits\HasActivityLog;
use App\Models\Traits\HasDeletedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContractUnitDetail extends Model
{
    use HasFactory, SoftDeletes, HasActivityLog, HasDeletedBy;

    protected $fillable = [
        'contract_id',
        'contract_unit_id',
        'unit_number',
        'unit_type_id',
        'floor_no',
        'unit_status_id',
        'unit_rent_per_annum',
        'fb_unit_count',
        'unit_size_unit_id',
        'unit_size',
        'property_type_id',
        'partition',
        'bedspace',
        'total_partition',
        'total_bedspace',
        'rent_per_partition',
        'rent_per_bedspace',
        'added_by',
        'updated_by',
        'deleted_by',
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function contract_unit()
    {
        return $this->belongsTo(ContractUnit::class);
    }

    public function unit_type()
    {
        return $this->belongsTo(UnitType::class);
    }

    public function unit_status()
    {
        return $this->belongsTo(UnitStatus::class);
    }

    public function unit_size_unit()
    {
        return $this->belongsTo(UnitSizeUnit::class);
    }

    public function property_type()
    {
        return $this->belongsTo(PropertyType::class);
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
