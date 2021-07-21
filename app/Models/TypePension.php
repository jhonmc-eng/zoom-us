<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypePension extends Model
{
    use HasFactory;
    protected $table = 'type_pensions';
    public $fillable = [
        'id',
        'name',
        'pension_id',
        'state_delete'
    ];
}
