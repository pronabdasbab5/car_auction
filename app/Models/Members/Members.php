<?php

namespace App\Models\Members;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Members extends Authenticatable
{
    use Notifiable;

    protected $guard = 'member';
    
    protected $table = 'members';

    protected $fillable = [
    	'category_id','userName', 'email', 'mobileNo', 'address', 'password', 'addressProof', 'idProof', 'isVerified', 'deposit', 'buyingLimit', 'availableLimit', 'status'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
