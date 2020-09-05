<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetails extends Model
{
    protected $table = 'invoice_details';
    protected $fillable = [
        'product_name',
        'unit',
        'quantity',
        'unit_price',
        'row_sub_total',
    ];


    /* ======================= START RELATION =========================== */
    public function invoice()
    {
        return $this->belongsTo('App\Invoice', 'invoice_id', 'id');
    }
    /* ======================= END RELATION =========================== */


    /* ======================= START SCOPE =========================== */
    public function scopeSubTotal($query){
        return $query->sum('row_sub_total');
    }
    /* ======================= END SCOPE =========================== */

}
