<?php

namespace App\Models;

use App\Models\Traits\HasActivityLog;
use App\Models\Traits\HasDeletedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgreementStatusLogs extends Model
{
    use HasFactory, SoftDeletes, HasActivityLog, HasDeletedBy;

    protected $table = 'agreement_status_logs';

    protected $fillable = [
        'agreement_id',
        'old_status',
        'new_status',
        'changed_at',
    ];

    protected $dates = [
        'changed_at',
    ];

    // Relationship to Agreement
    public function agreement()
    {
        return $this->belongsTo(Agreement::class, 'agreement_id');
    }
}
