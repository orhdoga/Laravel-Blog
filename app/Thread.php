<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    public function path() {
    	return "/threads/" . $thread->id;
    }

    public function user() {
    	return $this->belongsTo(User::class);
    }
}
