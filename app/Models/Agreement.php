<?php

namespace App\Models;

use App\Models\Traits\HasActivityLog;
use App\Models\Traits\HasDeletedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agreement extends Model
{
    use HasFactory, SoftDeletes, HasActivityLog, HasDeletedBy;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'agreements';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'agreement_code',
        'contract_id',
        'company_id',
        'start_date',
        'end_date',
        'duration_in_months',
        'duration_in_days',
        'is_emirates_id_uploaded',
        'is_passport_uploaded',
        'is_visa_uploaded',
        'is_signed_agreement_uploaded',
        'is_trade_license_uploaded',
        'agreement_status',
        'terminated_date',
        'terminated_reason',
        'terminated_by',
        'added_by',
        'updated_by',
        'deleted_by',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'terminated_date' => 'date',
        'is_emirates_id_uploaded' => 'boolean',
        'is_passport_uploaded' => 'boolean',
        'is_visa_uploaded' => 'boolean',
        'is_signed_agreement_uploaded' => 'boolean',
        'is_trade_license_uploaded' => 'boolean',
    ];

    /**
     * Define relationships (optional, based on foreign keys).
     */
    public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
    public function tenant()
    {
        return $this->hasOne(AgreementTenant::class, 'agreement_id');
    }
    public function agreement_documents()
    {
        return $this->hasMany(AgreementDocument::class, 'agreement_id');
    }
    public function agreement_payment()
    {
        return $this->hasOne(AgreementPayment::class, 'agreement_id');
    }
    public function agreement_payment_details()
    {
       return $this->hasMany(AgreementPaymentDetail::class, 'agreement_id');
    }
    public function agreemantUnit()
    {
        return $this->hasOne(AgreementUnit::class, 'agreement_id');
    }
    protected static function booted()
    {
        static::deleting(function ($agreement) {

            $userId = auth()->id();

            // hasOne relations
            $hasOneRelations = [
                'tenant',
                'agreement_documents',
                'agreement_payment',
                'agreemantUnit'

            ];

            // hasMany relations
            $hasManyRelations = [
                'agreement_payment_details',
            ];

            if (!$agreement->isForceDeleting()) {
                // Soft delete hasOne
                foreach ($hasOneRelations as $relation) {
                    $related = $agreement->$relation;
                    if ($related) {
                        $related->update(['deleted_by' => $userId]);
                        $related->delete();
                    }
                }

                // Soft delete hasMany
                foreach ($hasManyRelations as $relation) {
                    foreach ($agreement->$relation as $related) {
                        $related->update(['deleted_by' => $userId]);
                        $related->delete();
                    }
                }
            } else {
                // Force delete
                foreach (array_merge($hasOneRelations, $hasManyRelations) as $relation) {
                    $agreement->$relation()->withTrashed()->forceDelete();
                }
            }
        });

        static::restoring(function ($agreement) {
            $relations = [
                'tenant',
                'agreement_documents',
                'agreement_payment',
                'agreemantUnit',
                'agreement_payment_details',
            ];

            foreach ($relations as $relation) {
                $agreement->$relation()->withTrashed()->restore();
            }
        });
    }
}
