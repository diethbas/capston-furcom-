<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Furparents extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'mobile_number',
        'city',
        'province',
        'password',
        'img'
    ];

    // Define relationship to furbabies
    public function furbabies()
    {
        return $this->hasMany(Furbabies::class);
    }
}


