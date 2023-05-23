<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'address', 'rooms', 'availability'];

    /**
     * Se define la relación de pertenencia al usuario.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
