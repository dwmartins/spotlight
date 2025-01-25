<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteColors extends Model
{
    protected $table = 'website_colors';

    protected $fillable = [
        'name', 'hex_value'
    ];
}
