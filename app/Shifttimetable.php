<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shifttimetable extends Model
{
    //
    protected $table = 'shifttimetables';
    public $primarykey = 'id';
    public $fillabe =['police_id', 'zonlist_id', 'shift_id','lat','lng'];
}
