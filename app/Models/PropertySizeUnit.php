<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $unit_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PropertySizeUnit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PropertySizeUnit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PropertySizeUnit query()
 * @method static \Illuminate\Database\Eloquent\Builder|PropertySizeUnit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertySizeUnit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertySizeUnit whereUnitName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertySizeUnit whereUpdatedAt($value)
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|PropertySizeUnit whereDeletedAt($value)
 * @mixin \Eloquent
 */
class PropertySizeUnit extends Model
{
    use HasFactory;
}
