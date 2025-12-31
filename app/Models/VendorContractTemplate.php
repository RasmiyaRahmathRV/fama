<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorContractTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'template_name',
        'version',
        'status',
    ];

    public function vendors()
    {
        return $this->hasOne(Vendor::class, 'contract_template_id');
    }

    public function contract_signature_dimensions()
    {
        return $this->hasMany(ContractSignatureDimension::class, 'contract_template_id');
    }
}
