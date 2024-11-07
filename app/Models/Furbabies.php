<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Furbabies extends Model
{
    use HasFactory;
    protected $table = 'furbabies';
    protected $primaryKey = 'furbabyID'; // Specify the primary key
    
    protected $fillable = [
        'furparentID',
        'name',
        'age',
        'description',
        'img',
        'ismissing'
    ];

    // Define relationship to furparent
    public function furparent()
    {
        return $this->belongsTo(Furparents::class);
    }
}
