<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';
    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_mobile',
        'company_name',
        'invoice_number',
        'invoice_date',
        'discount_type',
        'discount_value',
        'vat_value',
        'shipping',
        'total_due',
    ];


    /* ======================= START RELATION =========================== */
    public function details()
    {
        return $this->hasMany('App\InvoiceDetails', 'invoice_id', 'id');
    }
    /* ======================= END RELATION =========================== */



}
