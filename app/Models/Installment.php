<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Installment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'company_id',
        'installment_code',
        'installment_name',
        'added_by',
        'updated_by',
        'status',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
