<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['company_id', 'bank_code', 'bank_name', 'bank_short_code', 'added_by', 'updated_by', 'status'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
