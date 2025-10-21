<?php

namespace App\Models;

use App\Models\Traits\HasActivityLog;
use App\Models\Traits\HasDeletedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{

    protected $table = 'contracts';

    use HasFactory, SoftDeletes, HasActivityLog, HasDeletedBy;


    protected $fillable = [
        'project_code',
        'project_number',
        'company_id',
        'vendor_id',
        'contract_type_id',
        'contact_person',
        'contact_number',
        'area_id',
        'locality_id',
        'property_id',
        'is_vendor_contract_uploaded',
        'is_scope_generated',
        'contract_status',
        'is_aknowledgement_uploaded',
        'is_cheque_copy_uploaded',
        'parent_contract_id',
        'contract_renewal_status',
        'renewal_count',
        'renewal_date',
        'renewed_by',
        'added_by',
        'updated_by',
        'approved_by',
        'deleted_by',
        'scope_generated_by',
        'rejected_reason'
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function locality()
    {
        return $this->belongsTo(Locality::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function contract_type()
    {
        return $this->belongsTo(ContractType::class);
    }
    public function contract_detail()
    {
        return $this->hasOne(ContractDetail::class, 'contract_id', 'id');
    }
    public function contract_unit()
    {
        return $this->hasOne(ContractUnit::class, 'contract_id', 'id');
    }
    public function contract_rentals()
    {
        return $this->hasOne(ContractRental::class, 'contract_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(
            [User::class, 'renewed_by', 'id'],
            [User::class, 'added_by', 'id'],
            [User::class, 'updated_by', 'id'],
            [User::class, 'approved_by', 'id'],
            [User::class, 'deleted_by', 'id'],
            [User::class, 'scope_generated_by', 'id'],
        );
    }
}
