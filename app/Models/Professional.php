<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Professional extends Model
{
	
    use SoftDeletes;
    protected $table = 'professional';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','first_name', 'last_name', 'father_name', 'mother_name', 'address', 'district', 'state', 'zip', 'type', 'description','experience'
    ];

    
}
