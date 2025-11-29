<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function imprint()
    {
        return view('pages.imprint');
    }

    public function privacy()
    {
        return view('pages.privacy');
    }

    public function shipping()
    {
        return view('pages.shipping');
    }
}
