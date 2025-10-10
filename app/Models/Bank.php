<?php

namespace App\Models;

use App\Models\Traits\HasActivityLog;
use App\Models\Traits\HasDeletedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
    use HasFactory, SoftDeletes, HasActivityLog, HasDeletedBy;

    protected $fillable = ['company_id', 'bank_code', 'bank_name', 'bank_short_code', 'added_by', 'updated_by', 'status'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
