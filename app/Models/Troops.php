<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Troops extends Model
{
    use HasFactory;
    protected $fillable = [
        'friend_id',
        'furparent_id'
    ];
}
