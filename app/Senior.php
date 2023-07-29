<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Senior extends Model
{
    public $timestamps = false;
    public function requests(){
        return $this->belongsToMany(Group::class, 'requests','senior_id','group_id')->withPivot('status');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
