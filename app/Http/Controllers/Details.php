<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Details extends Controller
{
    public function detail(){
        $title='Détails';
        return view('details',array('title'=>$title));
    }
}
