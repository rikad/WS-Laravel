<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['code','description','class_id'];

    public function class()
    {
        return $this->belongsTo('App\Classes');
    }

    public $timestamps = false;
}
