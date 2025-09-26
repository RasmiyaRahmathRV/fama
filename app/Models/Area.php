<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'company_id',
        'area_code',
        'area_name',
        'added_by',
        'updated_by',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo([User::class, 'added_by', 'id'], [User::class, 'updated_by', 'id']);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function getCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = Carbon::parse($value)->format('d-m-Y');
    }

    public static function existsForCompany($area_name, $company_id)
    {
        return self::where('area_name', $area_name)
            ->where('company_id', $company_id)
            ->exists();
    }

    public function localities()
    {
        return $this->hasMany(Locality::class);
    }
}
