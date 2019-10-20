<?php

namespace App\Models\Apikey;

use Illuminate\Database\Eloquent\Model;

class Apikey extends Model
{
    protected $table = 'api_key';

    protected $fillable = ['userId', 'api_token'];
}
