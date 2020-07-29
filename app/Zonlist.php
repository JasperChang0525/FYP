<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zonlist extends Model
{
    //
    protected $table = 'zonlists';
    public $primarykey = 'zonlist_id';
    public function zonlist()
    {
        $this->hasMany('App\Zon');
    }
}
