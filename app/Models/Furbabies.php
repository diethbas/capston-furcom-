<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Furbabies extends Model
{
    use HasFactory;

    protected $fillable = [
        'furparentID',
        'name',
        'age',
        'description',
        'img'
    ];

    // Define relationship to furparent
    public function furparent()
    {
        return $this->belongsTo(Furparents::class);
    }
}
