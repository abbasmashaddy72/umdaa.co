<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $table = 'events';
    protected $fillable = ['title','status','date','image','location','content','category_id'];

    public function category(){
        return $this->hasOne(\App\EventsCategory::class,'id','category_id');
    }
}
