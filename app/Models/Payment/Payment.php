<?php

namespace App\Models\Payment;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment';

    protected $fillable = ['userId', 'msg', 'amount', 'payment_request_id', 'payment_id', 'status'];
}
