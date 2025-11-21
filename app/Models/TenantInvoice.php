<?php

namespace App\Models;

use App\Models\Traits\HasActivityLog;
use App\Models\Traits\HasDeletedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TenantInvoice extends Model
{
    use HasFactory, SoftDeletes, HasActivityLog, HasDeletedBy;

    protected $table = 'tenant_invoices';

    protected $fillable = [
        'agreement_id',
        'agreement_payment_detail_id',
        'invoice_path',
        'invoice_file_name',
        'added_by',
        'updated_by',
        'deleted_by',
    ];
}
