<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Threads extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipientID1',
        'recipientID2',
        'isread',
        'isreadTo',
        'threadID'
    ];

    public function hasUser($userId)
    {
        // Check if the user is either recipient1 or recipient2
        return $this->recipientID1 == $userId || $this->recipientID2 == $userId;
    }
    public function messages()
    {
        return $this->hasMany(Messages::class, 'threadID', 'threadID');
    }
    public function latestMessage()
    {
        return $this->hasOne(Messages::class, 'threadID', 'threadID')->latest();
    }
    
    public function furparent1()
    {
        return $this->belongsTo(Furparents::class, 'recipientID1', 'id');
    }

    public function furparent2()
    {
        return $this->belongsTo(Furparents::class, 'recipientID2', 'id');
    }
}
