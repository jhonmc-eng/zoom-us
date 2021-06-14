<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'rooms';

    protected $fillable = [
        'id',
        'room_name',
        'user_id',
        'room_email',
        'room_password',
        'state_delete'
    ];

    protected $hidden = [
        'syslog'
    ];

    
}
