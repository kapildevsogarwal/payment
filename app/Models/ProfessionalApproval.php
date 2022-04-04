<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfessionalApproval extends Model
{
	protected $table = 'prof_approval';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','professional_id','by_type','status'
    ];

    
}
