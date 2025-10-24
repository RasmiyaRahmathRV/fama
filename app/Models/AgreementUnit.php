<?php

namespace App\Models;

use App\Models\Traits\HasActivityLog;
use App\Models\Traits\HasDeletedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgreementUnit extends Model
{
    use HasFactory, SoftDeletes, HasActivityLog, HasDeletedBy;

    protected $table = 'agreement_units';

    protected $fillable = [
        'agreement_id',
        'unit_type_id',
        'contract_unit_details_id',
        'contract_subunit_details_id',
        'rent_per_annum',
        'added_by',
        'updated_by',
        'deleted_by',
    ];

    /**
     * Relationships
     */

    public function agreement()
    {
        return $this->belongsTo(Agreement::class);
    }

    public function unitType()
    {
        return $this->belongsTo(UnitType::class);
    }

    public function contractUnitDetail()
    {
        return $this->belongsTo(ContractUnitDetail::class);
    }

    public function contractSubunitDetail()
    {
        return $this->belongsTo(ContractSubunitDetail::class);
    }
}
