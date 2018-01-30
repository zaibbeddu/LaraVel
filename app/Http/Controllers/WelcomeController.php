<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    //
    public function welcome($name = '', $lastname ='', $age = 0, Request $req){
        
        $language = $req->input('lang');
        
        if ($name == '' && $lastname == '') {
            return view('welcome');
        } else {
            return "Hello ".$name." ".$lastname." ".$age." lang=".$language;
        }
    }
}
