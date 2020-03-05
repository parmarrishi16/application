<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    protected $uploads="/images/";
    protected $table="photos";
    protected $fillable=[
        'file'
    ];

    public $timestamps=false;


    public function getFileAttribute($value)
    {
        return $this->uploads.$value;
    }

    public function post()
    {
        return $this->belongsTo("App\Photo");
    }

}
