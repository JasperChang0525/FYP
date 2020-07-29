<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zon extends Model
{
    protected $table = 'zons';
    public $primarykey = 'zon_ukm';
    public function zon()
    {
        $this->belongsTo('App\Zonlist');
    }
}
