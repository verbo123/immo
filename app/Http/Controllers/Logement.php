<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Logement extends Controller
{
    public function loge(){
    $title='Logements';
    return view('logements',array('title'=>$title));
    }


}
