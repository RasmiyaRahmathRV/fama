<?php

namespace App\Models;

use App\Models\Traits\HasActivityLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfitInterval extends Model
{
    use HasFactory,  HasActivityLog;

    protected $table = 'profit_intervals';

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'profit_interval_name',
        'no_of_installments',
        'interval',
        'status'
    ];
}
