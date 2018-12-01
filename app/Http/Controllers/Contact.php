<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Contact extends Controller
{
    public function contact(){
        $title='Contactez-nous';
        return view('contact',array('title'=>$title));
    }
}
