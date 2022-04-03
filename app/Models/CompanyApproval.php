<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyApproval extends Model
{
	protected $table = 'company_approval';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','company_id','by_type','status'
    ];

    
}
