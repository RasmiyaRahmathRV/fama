<?php

namespace App\Models;

use App\Models\Traits\HasActivityLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageSetting extends Model
{
    use HasFactory, HasActivityLog;

    protected $fillable = [
        'message_type',
        'message_body',
        'status'
    ];
}
