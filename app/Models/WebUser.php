<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class WebUser extends Authenticatable
{
    use Notifiable;

    protected $table = 'webusers'; // Nombre personalizado

    protected $primaryKey = 'id_user';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public $timestamps = false; // Ya que no tienes created_at y updated_at
}

