<?php

namespace SpanIT\Model;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    protected $table = 'marks';
    protected $fillable = ['student_id','subject_id','mark'];
}
