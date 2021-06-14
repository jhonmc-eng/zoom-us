<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeMeet extends Model
{
    use HasFactory;
    protected $table = 'type_meets';
    
    protected $fillable = [
        'id',
        'room_id',
        'name',
        'state_delete'
    ];

    protected $hidden = [
        'syslog'
    ];
}
