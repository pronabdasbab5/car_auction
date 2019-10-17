<?php

namespace App\Models\Bid;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $table = 'bid';

    protected $fillable = ['vehicle_id', 'user_id', 'current_bid_amount', 'total_bid_amount', 'status'];
}
