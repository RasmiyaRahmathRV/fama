<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Auth;

trait HasDeletedBy
{
    public static function bootHasDeletedBy()
    {
        static::deleting(function ($model) {
            if (!$model->isForceDeleting()) {
                $model->deleted_by = auth()->user()->id;
                $model->saveQuietly();
            }
        });

        static::restoring(function ($model) {
            $model->deleted_by = null;
        });
    }

    public function deletedBy()
    {
        return $this->belongsTo(\App\Models\User::class, 'deleted_by');
    }
}
