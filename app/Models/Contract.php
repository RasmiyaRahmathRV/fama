<?php

namespace App\Models;

use App\Models\Traits\HasActivityLog;
use App\Models\Traits\HasDeletedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{

    protected $table = 'contracts';

    use HasFactory, SoftDeletes, HasActivityLog, HasDeletedBy;

    protected $fillable = [
        'project_code',
        'added_by',
        'updated_by',
        'deleted_by',
        'status'
    ];
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
