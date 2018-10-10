<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function user() {
        return $this->belongsToMany('App\User', 'participants');
    }

    public function category() {
        return $this->hasMany('App\Category', 'category');
    }

    public function customer() {
        return $this->belongsTo('App\Customer', 'customer_id');
    }
}
