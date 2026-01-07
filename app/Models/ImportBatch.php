<?php

namespace App\Models;

use App\Models\Traits\HasActivityLog;
use App\Models\Traits\HasDeletedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $file_name
 * @property int|null $total_rows
 * @property int $processed_rows
 * @property string $status
 * @property int $added_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ImportBatch newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImportBatch newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImportBatch query()
 * @method static \Illuminate\Database\Eloquent\Builder|ImportBatch whereAddedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImportBatch whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImportBatch whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImportBatch whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImportBatch whereProcessedRows($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImportBatch whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImportBatch whereTotalRows($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImportBatch whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ImportBatch extends Model
{

    use HasFactory, HasActivityLog, HasDeletedBy;

    protected $fillable = [
        'file_name',
        'total_rows',
        'processed_rows',
        'status',
        'added_by'
    ];
}
