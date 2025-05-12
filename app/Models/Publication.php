<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    protected $table = 'publications';
    protected $primaryKey = 'id_publication';

    // Activamos timestamps pero solo el de creación
    public $timestamps = false;

    protected $fillable = [
        'iduser_fk',
        'title',
        'message',
        'created_at'
    ];

    /**
     * Relación con el modelo de usuario.
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\WebUser::class, 'iduser_fk');
    }
}
