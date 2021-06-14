<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'meetings';

    protected $fillable = 
                            [
                                'id',
                                'user_id',
                                'room_id',
                                'date_start',
                                'meeting_duration',
                                'type_meet_id',
                                'url',
                                'meeting_room_id',
                                'meeting_room_code',
                                'theme',
                                'state_delete'
                            ];
    protected $hidden = 
                            [
                                'syslog'
                            ];

}
