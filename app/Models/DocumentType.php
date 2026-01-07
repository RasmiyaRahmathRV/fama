<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    use HasFactory;

    protected $fillable = [
        'label_name',
        'field_type',
        'field_name',
        'status_change_value',
        'status',
        'accept_types'
    ];


    public function contractDocuments()
    {
        return $this->hasOne(contractDocument::class);
    }
}
