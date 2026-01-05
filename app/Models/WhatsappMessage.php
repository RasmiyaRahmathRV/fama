<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsappMessage extends Model
{
    use HasFactory;
    protected $table = 'whatsapp_messages';
    protected $fillable = [
        'phone',
        'investor_id',
        'template_id',
        'variables',
        'payload',
        'response',
        'status',
    ];
}
