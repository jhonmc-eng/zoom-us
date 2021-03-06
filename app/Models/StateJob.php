<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StateJob extends Model
{
    use HasFactory;

    public $timestamps = TRUE;

    protected $table = 'states_jobs';

    protected $fillable = [
        'id',
        'name',
        'description',
        'state_delete',
        'syslog'
    ];
    protected $hidden = [
        'syslog',
        'updated_at',
        'created_at'
    ];
}
