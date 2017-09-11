<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function threads() {
    	return $this->hasMany(Thread::class);
    }

    public function getRouteKeyName() {
    	return "name";
    }
}
