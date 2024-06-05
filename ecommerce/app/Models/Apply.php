<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'artist_name', 'dob', 'address', 'contact_number', 'reason', 'mediums'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}