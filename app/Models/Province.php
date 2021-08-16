<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $table = 'provinces';

    public $fillable = [
        'id',
        'name',
        'departament_id'
    ];
    protected $hidden = [
        'syslog',
        'updated_at',
        'created_at'
    ];
}
