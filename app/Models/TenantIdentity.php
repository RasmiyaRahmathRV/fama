<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantIdentity extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tenant_identities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'identity_type',
        'first_field_name',
        'first_field_id',
        'first_field_type',
        'first_field_label',
        'second_field_name',
        'second_field_id',
        'second_field_type',
        'second_field_label',
        'show_status',
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'show_status' => 'boolean',
    ];
}
