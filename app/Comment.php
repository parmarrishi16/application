<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table="comments";
    protected $fillable=[
        'post_id',
        'is_active',
        'title',
        'email',
        'body'
    ];

    public function replies()
    {
        return $this->hasMany("App\Reply");
    }
}
