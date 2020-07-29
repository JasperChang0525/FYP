<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
     //Change Table name 
     protected $table = 'posts';
     //Change Primary Key
     public $primaryKey ='id';
     //Change Timestamps
     public $timestamps =true;
}
