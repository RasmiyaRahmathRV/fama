<?php

namespace App\Models;

use App\Models\Traits\HasActivityLog;
use App\Models\Traits\HasDeletedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Investor extends Model
{
    use HasFactory, SoftDeletes, HasActivityLog, HasDeletedBy;

    protected $fillable = [
        'investor_code',
        'investor_name',
        'investor_mobile',
        'investor_email',
        'investor_address',
        'nationality_id',
        'country_of_residence',
        'payment_mode_id',
        'id_number',
        'passport_number',
        'reference_id',
        'payout_batch_id',
        'profit_release_date',
        'status',
        'total_no_of_investments',
        'total_invested_amount',
        'total_profit_received',
        'total_referal_commission_received',
        'total_terminated_investments',
        'is_passport_uploaded',
        'is_supp_doc_uploaded',
        'is_ref_com_cont_uploaded',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }

    public function countryOfReference()
    {
        return $this->belongsTo(Nationality::class, 'country_of_residence', 'id');
    }

    public function paymentMode()
    {
        return $this->belongsTo(PaymentMode::class, 'payment_mode_id', 'id');
    }

    public function reference()
    {
        return $this->belongsTo(Investor::class, 'reference_id', 'id');
    }

    public function payoutBatch()
    {
        return $this->belongsTo(PayoutBatch::class, 'payout_batch_id', 'id');
    }
}
