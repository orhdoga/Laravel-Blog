<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $guarded = [];

    public function path() {
    	return "/threads/" . $this->tag->name . "/" . $this->id;
    }

    public function user() {
    	return $this->belongsTo(User::class);
    }

    public function tag() {
    	return $this->belongsTo(Tag::class);
    }

    public function scopeSearch($query, $s) {
    	return $query->where("title", "like", "%" . $s . "%")
    		->orWhere("description", "like", "%" . $s . "%")
    		->orWhere("body", "like", "%" . $s . "%");
    }

    public function comments() {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'asc');
    }

    public function addComment(array $comment) {
        $this->comments()->create($comment);
    }
}
