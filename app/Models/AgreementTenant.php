<?php

namespace App\Models;

use App\Models\Traits\HasActivityLog;
use App\Models\Traits\HasDeletedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgreementTenant extends Model
{
    use HasFactory, SoftDeletes, HasActivityLog, HasDeletedBy;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'agreement_tenants';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'agreement_id',
        'tenant_name',
        'tenant_mobile',
        'tenant_email',
        'nationality_id',
        'tenant_address',
        'added_by',
        'updated_by',
        'deleted_by',
        'contact_person',
        'contact_number',
        'contact_email'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */


    /**
     * Relationship: belongs to Agreement
     */
    public function agreement()
    {
        return $this->belongsTo(Agreement::class, 'agreement_id');
    }
    public function nationality()
    {
        return $this->belongsTo((Nationality::class));
    }
}
