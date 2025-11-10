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
        'rejected_reason',
        'is_agreement_added',
        'renew_reject_status',
        'renew_reject_reason',
        'renew_rejected_by',
        'contract_rejected_by',
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
    public function contract_documents()
    {
        return $this->hasOne(ContractDocument::class, 'contract_id', 'id');
    }
    public function contract_otc()
    {
        return $this->hasOne(ContractOtc::class, 'contract_id', 'id');
    }
    public function contract_payments()
    {
        return $this->hasOne(ContractPayment::class, 'contract_id', 'id');
    }
    public function contract_payment_details()
    {
        return $this->hasMany(ContractPaymentDetail::class, 'contract_id', 'id');
    }
    public function contract_subunit_details()
    {
        return $this->hasMany(ContractSubunitDetail::class, 'contract_id', 'id');
    }
    public function contract_unit_details()
    {
        return $this->hasMany(ContractUnitDetail::class, 'contract_id', 'id');
    }
    public function contract_payment_receivables()
    {
        return $this->hasMany(ContractPaymentReceivable::class, 'contract_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Contract::class, 'parent_contract_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(Contract::class, 'parent_contract_id', 'id');
    }

    public function getAllRenewals()
    {
        $renewals = collect();

        foreach ($this->children as $child) {
            $renewals->push($child);
            $renewals = $renewals->merge($child->getAllRenewals());
        }

        return $renewals;
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


    protected static function booted()
    {
        static::deleting(function ($contract) {

            $userId = auth()->id();

            // hasOne relations
            $hasOneRelations = [
                'contract_detail',
                'contract_unit',
                'contract_rentals',
                'contract_documents',
                'contract_otc',
                'contract_payments',
                'contract_payment_receivables'
            ];

            // hasMany relations
            $hasManyRelations = [
                'contract_payment_details',
                'contract_subunit_details',
                'contract_unit_details',
            ];

            if (!$contract->isForceDeleting()) {
                // Soft delete hasOne
                foreach ($hasOneRelations as $relation) {
                    $related = $contract->$relation;
                    if ($related) {
                        if ($userId) {
                            $related->update(['deleted_by' => $userId]);
                        }
                        $related->delete();
                    }
                }

                // Soft delete hasMany
                foreach ($hasManyRelations as $relation) {
                    $relatedCollection = $contract->$relation ?? collect();
                    foreach ($relatedCollection as $related) {
                        if ($userId) {
                            $related->update(['deleted_by' => $userId]);
                        }
                        $related->delete();
                    }
                }
            } else {
                // Force delete
                foreach (array_merge($hasOneRelations, $hasManyRelations) as $relation) {
                    $contract->$relation()->withTrashed()->forceDelete();
                }
            }
        });

        static::restoring(function ($contract) {
            $relations = [
                'contract_detail',
                'contract_unit',
                'contract_rentals',
                'contract_documents',
                'contract_otc',
                'contract_payments',
                'contract_payment_receivables',
                'contract_payment_details',
                'contract_subunit_details',
                'contract_unit_details'
            ];

            foreach ($relations as $relation) {
                $contract->$relation()->withTrashed()->restore();
            }
        });
    }
}
