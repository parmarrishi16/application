<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    //
    protected $table="replies";
    protected $fillable=[
        'comment_id',
        'is_active',
        'author',
        'file',
        'email',
        'body'
    ];

    public function comments()
    {
        return $this->belongsTo("App\Comment");
    }
}
