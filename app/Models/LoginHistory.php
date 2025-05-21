<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoginHistory extends Model
{
    use HasFactory;

    protected $table = 'login_histories';
    /**
     * Los atributos que son asignables a LoginHistory.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'ip',
        'user_agent',
    ];

    /**
     * Relacion de LoginHistory con un solo User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
