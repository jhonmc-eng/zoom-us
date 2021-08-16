<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $table = 'districts';
    public $fillable = [
        'id',
        'name',
        'departament_id',
        'province_id'
    ];

    protected $hidden = [
        'syslog',
        'updated_at',
        'created_at'
    ];

}
