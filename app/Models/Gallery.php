<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['slug', 'title'];

    public function images(){
    	return $this->hasMany('App\Models\Image');
    }
}
