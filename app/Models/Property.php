<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['company_id', 'area_id', 'locality_id', 'property_type_id', 'property_code', 'property_name', 'property_size', 'property_size_unit', 'plot_no', 'added_by', 'updated_by', 'status'];

    public function user()
    {
        return $this->belongsTo([User::class, 'added_by', 'id'], [User::class, 'updated_by', 'id']);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function locality()
    {
        return $this->belongsTo(Locality::class);
    }

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }

    public function propertySizeUnit()
    {
        return $this->belongsTo(PropertySizeUnit::class);
    }
}
