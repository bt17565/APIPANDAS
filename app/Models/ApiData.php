<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiData extends Model
{
    use HasFactory;

    protected $table="api_data";

    protected $fillable = [
        'city_id',
        'city_name',
        'weather_details',
        'recorded_at',
    ];
}
