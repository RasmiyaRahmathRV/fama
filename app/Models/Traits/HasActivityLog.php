<?php

namespace App\Models\Traits;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

trait HasActivityLog
{
    public static function bootHasActivityLog()
    {
        static::created(function ($model) {
            $model->addActivityLog('created');
        });

        static::updated(function ($model) {
            $changes = $model->getDirty();
            $model->addActivityLog('updated', $changes);
        });

        static::deleting(function ($model) {
            if (method_exists($model, 'isForceDeleting') && !$model->isForceDeleting()) {
                $model->addActivityLog('deleted');
            }
        });

        if (in_array(\Illuminate\Database\Eloquent\SoftDeletes::class, class_uses_recursive(static::class))) {
            static::restored(function ($model) {
                $model->addActivityLog('restored');
            });
        }
    }

    protected function addActivityLog(string $action, array $changes = [])
    {

        $currentUrl = Request::fullUrl();
        $description = $description ?? "{$action} performed on " . class_basename($this);
        $description .= " (URL: {$currentUrl})";

        ActivityLog::create([
            'user_id'   => Auth::id(),
            'module'    => $this->getTable(),
            'record_id' => $this->id,
            'action'    => $action,
            'description' => $description,
            'changes'   => $changes ? json_encode($changes) : null,
            'created_at' => now(),
        ]);
    }
}
