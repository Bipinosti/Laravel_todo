<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{

    //refactor needed
    protected $fillable = ['name', 'user_id','checked'];
}
