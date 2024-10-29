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
        'threadID'
    ];

    public function hasUser($userId)
    {
        // Check if the user is either recipient1 or recipient2
        return $this->recipientID1 == $userId || $this->recipientID2 == $userId;
    }
}
