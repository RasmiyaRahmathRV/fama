<?php

namespace App\Models;

use App\Services\CodeGeneratorService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    use HasFactory;

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

    public function setCompanyCode()
    {
        $codeService = new \App\Services\CodeGeneratorService();
        $this->attributes['company_code'] = $codeService->generateNextCode('companies', 'company_code', 'CMP', 5);
    }
}
