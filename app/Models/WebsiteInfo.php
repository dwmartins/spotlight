<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteInfo extends Model
{
    protected $table = 'website_info';

    protected $fillable = [
        'webSiteName', 'email', 'phone', 'city', 'state', 'address',
        'instagram', 'facebook', 'x', 'description', 'keywords',
        'favicon', 'logoImage', 'coverImage', 'defaultImage',
    ];
}
