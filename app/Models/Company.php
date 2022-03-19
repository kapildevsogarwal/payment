<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
	
    use SoftDeletes;
    protected $table = 'company_info';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'address','type','catalog_first','catalog_second','catalog_third', 'catalog_four', 'catalog_five','user_id','gst','district','state','zip'
    ];

    
}
