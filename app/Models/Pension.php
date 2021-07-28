<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pension extends Model
{
    use HasFactory;
    protected $table = 'pensions';
    public $fillable = [
        'id',
        'name',
        'state_delete'
    ];
}
