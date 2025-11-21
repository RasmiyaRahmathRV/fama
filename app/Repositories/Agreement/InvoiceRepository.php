<?php

namespace App\Repositories\Agreement;


use App\Models\TenantInvoice;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class InvoiceRepository
{
    public function create_invoice($data)
    {

        return TenantInvoice::create($data);
    }
    public function update_invoice($data)
    {
        $invoice = $this->find($data['invoice_id']);
        unset($data['invoice_id']);
        $invoice->update($data);
        return $invoice;
    }
    public function find($id)
    {
        return TenantInvoice::findOrFail($id);
    }
}
