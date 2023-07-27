<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public $timestamps = false;
    public function requests(){
        return $this->belongsToMany(Senior::class, 'requests','group_id', 'senior_id')->withPivot('status');
    }
}
