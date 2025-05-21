<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * TAtributos que pueden ser llenados en el modelo User.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'email_sent',
    ];


    /**
     * Relacion donde cada user posee un solo Profile.
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * Relacion de historial de inicios de sesión con usuario.
     */
    public function loginHistory(): HasMany
    {
        return $this->hasMany(LoginHistory::class);
    }
}
