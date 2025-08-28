<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [
        'area_code',
        'area_name',
        'added_by',
        'added_date',
        'status'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($area) {
            // Get last record
            $lastCode = self::orderBy('id', 'desc')->value('area_code');

            if ($lastCode) {
                // Extract number part (ARE001 → 1)
                $number = intval(substr($lastCode, 3)) + 1;
            } else {
                $number = 1;
            }

            // Generate new code
            $area->area_code = 'ARE' . str_pad($number, 3, '0', STR_PAD_LEFT);
        });
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'added_by', 'id');
    }

    public function setAddedDateAttribute($value)
    {
        $this->attributes['added_date'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }
}
