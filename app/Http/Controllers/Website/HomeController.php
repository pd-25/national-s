<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('website.index');
    }
    
    public function general()
    {
        return view('website.general');
    }

    public function aboutus()
    {
        return view('website.aboutus');
    }

    public function principalsdesk()
    {
        return view('website.principalsdesk');
    }

    public function schooltimings()
    {
        return view('website.schooltimings');
    }

    public function schooluniform()
    {
        return view('website.schooluniform');
    }

    public function rulesregulations()
    {
        return view('website.rulesregulations');
    }
    
    public function cocurricular()
    {
        return view('website.cocurricular');
    }

}