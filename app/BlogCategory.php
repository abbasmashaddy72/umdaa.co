<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $table ='department';
    protected $primaryKey = 'department_id';
    protected $fillable = ['department_name','status'];
}
