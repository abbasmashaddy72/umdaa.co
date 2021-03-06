<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Knowledgebase extends Model
{
    protected $table = 'knowledgebases';
    protected $fillable = ['title','status','topic_id','content','views'];

    public function topic(){
        return $this->hasOne(\App\KnowledgebaseTopic::class,'id','topic_id');
    }
}
