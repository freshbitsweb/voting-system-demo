<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Display home page
     *
     * @return \Illuminate\Http\Response
     **/
    public function index()
    {
        return view('home');
    }
}
