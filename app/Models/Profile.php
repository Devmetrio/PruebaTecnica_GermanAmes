<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    use HasFactory;

    /**
     * Atributos que pueden ser llenados en el modelo Profile.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'age',
        'phone',
    ];

    /**
     * Relacion donde cada profile pertenece a un solo usuario.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
