<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusCivil extends Model
{
    use HasFactory;

    protected $table = 'status_civil';
    public $fillable = [
        'id',
        'name',
        'state_delete'
    ];
    protected $hidden = [
        'syslog',
        'updated_at',
        'created_at'
    ];
}
