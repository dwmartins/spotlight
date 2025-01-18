<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    // Sets the primary key of the table
    protected $primaryKey = 'name';

    // Indicates that the primary key is not auto-incremented
    public $incrementing = false;

    // Defines the primary key type
    protected $keyType = 'string';

    // Permite que o Laravel use a tabela 'settings' para essa model
    protected $table = 'settings';

    // Defines the attributes that can be filled in bulk
    protected $fillable = [
        'name',
        'value',
    ];

    // If the database manages timestamps (like updated_at), disable Eloquent's control
    public $timestamps = false;
}
