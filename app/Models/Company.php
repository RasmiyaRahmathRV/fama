<?php

namespace App\Models;

use App\Services\CodeGeneratorService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    protected $table = 'companies';

    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'company_code',
        'company_name',
        'industry',
        'address',
        'phone',
        'email',
        'website',
        'added_by',
        'updated_by',
        'status'
    ];

    public function areas()
    {
        return $this->hasMany(Area::class);
    }

    public function user()
    {
        return $this->belongsTo([User::class, 'added_by', 'id'], [User::class, 'updated_by', 'id']);
    }

    public function setAddedDateAttribute($value)
    {
        $this->attributes['added_date'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function setUpdatedDateAttribute($value)
    {
        $this->attributes['updated_date'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }
}
