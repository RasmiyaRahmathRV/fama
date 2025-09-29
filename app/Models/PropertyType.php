<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $company_id
 * @property string $property_type_code
 * @property string $property_type
 * @property int $added_by
 * @property int|null $updated_by
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Company|null $company
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyType onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyType query()
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyType whereAddedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyType whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyType wherePropertyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyType wherePropertyTypeCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyType whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyType whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyType withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyType withoutTrashed()
 * @method static \Database\Factories\PropertyTypeFactory factory($count = null, $state = [])
 * @mixin \Eloquent
 */
class PropertyType extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['company_id', 'property_type_code', 'property_type', 'added_by', 'updated_by', 'status'];

    public function user()
    {
        return $this->belongsTo([User::class, 'added_by', 'id'], [User::class, 'updated_by', 'id']);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
