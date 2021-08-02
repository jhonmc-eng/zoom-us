<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Knowledge extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $table = 'knowledge';

    protected $fillable = [
        'id',
        'candidate_id',
        'name',
        'detail',
        'knowledge_level_id',
        'state_delete',
        'syslog'
    ];
    

    public function levelKnowledge(){
        return $this->hasOne('App\Models\LevelKnowledge', 'id', 'knowledge_level_id');
    }
}
