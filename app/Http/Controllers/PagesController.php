<?php

namespace App\Http\Controllers;

use App\Property;
use Illuminate\Support\Facades\Cookie;

class PagesController extends Controller
{
    public function index()
    {
        $slider_properties = Property::limit(3)->get();
        $featured_properties = Property::latest()->limit(9)->get();
        $recently_viewed_properties = Cookie::get('properties') ? Property::limit(9)->find(Cookie::get('properties')) : [];
        return view('index', compact(['featured_properties', 'slider_properties', 'recently_viewed_properties']));
    }

    public function contact()
    {
        return view('contact');
    }

    public function privacy()
    {
        return view('privacy');
    }

    public function terms()
    {
        return view('terms');
    }

    public function urSpecials()
    {
        return view('ur-specials');
    }

    public function about()
    {
        return view('about');
    }
}
