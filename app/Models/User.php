<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
   
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',
        'rol_id', 
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    //SI HAY UNA LLAVE FORANEA SE DEBE DEFINIR LA RELACION ENTRE MODELOS
    //RELACION DE UNO A MUCHOS INVERSA
    public function rol(): BelongsTo 
    {
        return $this->belongsTo(related: Rol::class, foreignKey: 'rol_id'); // de uno a muchos solo tiene 1
    }

    public function Toshow(): array
    {
        return [
            'username' => $this->username,
            'email' => $this->email,
            'rol' => $this->rol->name ?? null, // Accede al nombre del rol relacionado
        ];
    }
}
