<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
	protected $table = 'company_info';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'address','type','catalog_first','catalog_second','catalog_third', 'catalog_four', 'catalog_five'
    ];

    
}
