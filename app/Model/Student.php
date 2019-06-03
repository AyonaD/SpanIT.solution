<?php

namespace SpanIT\Model;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    protected $fillable = ['first_name','last_name','age'];
}
