<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $guarded = [];

    public function sub_category(){

        return $this->hasMany('App\category', 'parent_id')->with('sub_category');

    }
}
