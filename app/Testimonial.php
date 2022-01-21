<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $table ='doctors';
    protected $fillable = ['name','image','description','designation'];
}
