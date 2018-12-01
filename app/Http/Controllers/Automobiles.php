<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Automobiles extends Controller
{
   public function auto(){
       $title='Automobile';
       return view('automobiles',array('title'=>$title));
   }
}
