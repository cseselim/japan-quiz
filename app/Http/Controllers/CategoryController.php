<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;

class CategoryController extends Controller
{
    public function category($value='')
    {
    	 $categories = category::with('sub_category')->where('parent_id','0')->get();
    	 return $categories;
    }
}
