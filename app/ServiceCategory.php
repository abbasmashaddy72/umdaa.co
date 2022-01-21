<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    protected $table = 'department';
    protected $fillable = ['department_name'];
}
