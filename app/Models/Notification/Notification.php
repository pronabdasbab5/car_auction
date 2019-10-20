<?php

namespace App\Models\Notification;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = "notification";

    protected $fillable = ['title', 'desc'];
}
