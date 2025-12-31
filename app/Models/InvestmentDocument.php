<?php

namespace App\Models;

use App\Models\Traits\HasActivityLog;
use App\Models\Traits\HasDeletedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvestmentDocument extends Model
{
    use HasFactory,  SoftDeletes, HasActivityLog, HasDeletedBy;

    protected $table = 'investment_documents';

    protected $fillable = [
        'investment_id',
        'investor_id',
        'investment_contract_file_name',
        'investment_contract_file_path',
        'added_by',
        'updated_by',
        'deleted_by',
    ];
}
