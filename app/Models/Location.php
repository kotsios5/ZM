<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    const EARTH_RADIUS = 6371;

    protected $fillable = ['name', 'latitude', 'longitude'];
}
