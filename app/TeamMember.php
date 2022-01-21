<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $table = 'doctors';
    protected $primaryKey = 'doctor_id';
    protected $fillable = ['first_name','last_name','qualification','profile_image','department_id'];
    public function department(){
        return $this->belongsTo(\App\BlogCategory::class,'department_id');
    }
}
