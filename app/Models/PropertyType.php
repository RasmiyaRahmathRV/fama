<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyType extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['company_id', 'property_type_code', 'property_type', 'added_by', 'updated_by', 'status'];

    public function user()
    {
        return $this->belongsTo([User::class, 'added_by', 'id'], [User::class, 'updated_by', 'id']);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
