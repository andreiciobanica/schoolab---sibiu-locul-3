<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class viewController extends Controller
{
    public function contact(){
    	return view('contact');
    }

    public function home() {
        return view('welcome');
    }
}
