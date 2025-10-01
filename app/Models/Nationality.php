<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nationality extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['company_id', 'nationality_code', 'nationality_name', 'nationality_short_code', 'added_by', 'updated_by', 'status'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
