<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bundler extends Model
{
    use HasFactory;

    protected $table = 'bundlers';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'endpoint_1',
        'iterative_index',
        'method_1',
        'headers_1',
        'data_1',
        'response_type_1',
        'response_content_1',
        'endpoint_2',
        'method_2',
        'headers_2',
        'data_2',
        'response_type_2',
        'response_content_2',
        'modifications',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
