<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Se define la relación uno a muchos con los hoteles.
     */
    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }

    /**
     * Se define la relación uno a muchos con los apartamentos.
     */
    public function apartments()
    {
        return $this->hasMany(Apartment::class);
    }

    /**
     * Se define la asignación del rol 'asociado' a los usuarios que se registran.
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            $user->assignRole('asociado');
        });
    }



}
