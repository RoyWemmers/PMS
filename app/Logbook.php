<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    public function project() {
        return $this->belongsTo('App\Project', 'project_id');
    }
}
