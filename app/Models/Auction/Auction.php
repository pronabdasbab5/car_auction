<?php

namespace App\Models\Auction;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    protected $table = 'auction_group_name';

    protected $fillable = ['category_id', 'auction_group_name', 'start_date', 'end_date', 'status'];
}
