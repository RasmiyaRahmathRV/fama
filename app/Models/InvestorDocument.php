<?php

namespace App\Models;

use App\Models\Traits\HasActivityLog;
use App\Models\Traits\HasDeletedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvestorDocument extends Model
{
    use HasFactory, SoftDeletes, HasActivityLog, HasDeletedBy;

    protected $fillable = [
        'investor_id',
        'document_type',
        'document_name',
        'document_path',
        'added_by',
        'updated_by',
        'deleted_by',
    ];

    public function investor()
    {
        return $this->belongsTo(Investor::class);
    }
}
