<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMode extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['company_id', 'payment_mode_code', 'payment_mode_name', 'payment_mode_short_code', 'added_by', 'updated_by', 'status'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
