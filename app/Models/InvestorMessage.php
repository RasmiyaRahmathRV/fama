<?php

namespace App\Models;

use App\Models\Traits\HasActivityLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestorMessage extends Model
{
    use HasFactory, HasActivityLog;

    protected $fillable = [
        'message_setting_id',
        'investor_id',
        'investment_id',
        'investor_mobile',
        'investor_message_body',
        'send_status',
        'api_return',
        'send_by',
        'send_at',
    ];
}
