<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oficine extends Model
{
    use HasFactory;
    public $timestamps = TRUE;

    protected $table = 'oficines';

    protected $fillable = [
        'id',
        'name',
        'siglas',
        'state_delete',
        'syslog'
    ];
    protected $hidden = [
        'syslog',
        'updated_at',
        'created_at'
    ];
}
