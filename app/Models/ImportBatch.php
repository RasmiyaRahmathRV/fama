<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportBatch extends Model
{

    use HasFactory;

    protected $fillable = [
        'file_name',
        'total_rows',
        'processed_rows',
        'status',
        'added_by'
    ];
}
