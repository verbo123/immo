<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class All extends Controller
{
    public function all_article(){
        $title='Articles';
        return view('all',array('title'=>$title));
    }


}
