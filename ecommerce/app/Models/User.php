<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $attributes = [
        'role' => 2, // Default role is user
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function artworks() {
        return $this->hasMany(Artwork::class);
    }
}
