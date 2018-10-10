<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    public function projects() {
        return $this->belongsToMany('App\Project', 'projects');
    }
}
