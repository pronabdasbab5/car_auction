<?php

namespace App\Models\Vehicle;

use Illuminate\Database\Eloquent\Model;

class Vehicleimages extends Model
{
    protected $table = 'vehicle_images';

    protected $fillable = ['category_id', 'img_path'];
}
