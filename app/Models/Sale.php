<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
	
    use SoftDeletes;
    protected $table = 'sales_bill';
	protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_no', 'invoice_date', 'party_id', 'net_amount', 'igst_percent', 'igst_total', 'ca_gst_percent', 'ca_gst_total', 'sgst_percent', 'sgst_total', 'total_amount'
    ];

    
}
