<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\word;
class lesson extends Model
{
    protected $guarded = [];

    public function all_lesson(){

        return $this->hasMany(lesson::class);

    }

   public function all_word()
   {
       /*return $this->hasMany('App\word');*/
       return $this->belongsToMany('App\word', 'lesson_id');
   }
   
   public function all_question()
   {
       return $this->hasMany('App\question');
   }

}
