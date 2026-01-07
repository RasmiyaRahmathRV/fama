<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'permission_name',
        'parent_id',
    ];

    public function parent()
    {
        return $this->belongsTo(Permission::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Permission::class, 'parent_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_permissions');
    }

    public function isParent()
    {
        return is_null($this->parent_id);
    }

    public function getSubmoduleName()
    {
        return explode('.', $this->permission_name)[1] ?? null;
    }
}
