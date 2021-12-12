<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\lesson;

class word extends Model
{
	protected $guarded = [];
		
    public function all_word()
    {
        return $this->belongsTo('App\lesson');
    }
}
