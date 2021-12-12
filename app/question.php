<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\lesson;
use App\question;

class question extends Model
{
	protected $guarded = [];

   public function all_question()
   {
       return $this->belongsTo('App\question');
   }

   public function question_ans()
   {
   	 return $this->hasMany('App\answer');
   }
}
