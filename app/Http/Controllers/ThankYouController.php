<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThankYouController extends Controller
{
    public function __invoke()
    {
        return view('frontend.pages.thankYou');
    }
}
