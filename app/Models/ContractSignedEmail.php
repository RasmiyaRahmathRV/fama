<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractSignedEmail extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_id',
        'vendor_id',
        'email_to',
        'email_subject',
        'email_body',
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract_id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }
}
