<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractSignatureDimension extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_template_id',
        'page_type',
        'x',
        'y',
        'width',
    ];

    public function contract_template()
    {
        return $this->belongsTo(VendorContractTemplate::class, 'contract_template_id');
    }
}
