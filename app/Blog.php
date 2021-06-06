<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
	protected $fillable = [
        'title','thumbnail','slug','user_id','description','status',
    ];

    protected $hidden = [

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class, 'blog_id','id');
    }
}
