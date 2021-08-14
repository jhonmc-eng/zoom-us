<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelKnowledge extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $table = 'knowledge_level';

    protected $fillable = [
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