<?php

namespace App\Http\Controllers;

use App\Feature;
use App\Property;
use Illuminate\Http\Request;
use App\Mail\PropertyEnquiry;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;

class PropertiesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'enquiry']);
    }

    public function index(Request $request)
    {
        $options = collect($request->all());
        $properties = Property::with('user')
            ->filter($options)
            ->sort($options)
            ->simplePaginate(6);
        $properties->appends($options->toArray());

        return view('listings', compact('properties', 'options'));
    }

    public function show(Property $property)
    {
        $similarProperties = Property::limit(3)->get();
        $featuredProperties = Property::limit(3)->get();
        $recentCookies = Cookie::get('properties') ?: [];
        array_unshift($recentCookies, $property->id);
        Cookie::queue('properties', $recentCookies);

        return view('property', compact('property', 'similarProperties', 'featuredProperties'));
    }

    public function create(Request $request)
    {
        $features = Feature::all();
        $property = new Property(['status' => $request->input('status'), 'type' => $request->input('type')]);

        return view('submit', compact(['property', 'features']));
    }

    public function store(Request $request)
    {
        $property = Auth::user()->properties()->create($request->except(['features']));
        $property->features()->attach($request->input('features'));

        return redirect()->route('properties.show', $property->id);
    }

    public function edit(Property $property)
    {
        $features = Feature::all();
        $edit = true;

        return view('submit', compact(['property', 'features', 'edit']));
    }

    public function update(Request $request, Property $property)
    {
        $property->update($request->except(['features']));
        $property->features()->sync($request->input('features'));

        return redirect()->route('properties.update', ['id' => $property->id]);
    }

    public function destroy(Property $property)
    {
        $property->delete();

        return ['result' => true];
    }

    public function enquiry(Request $request, Property $property)
    {
        Mail::to($property->user->email)
            ->send(new PropertyEnquiry($property, $request->all()));

        return Redirect::to(URL::previous() . '#enquiry-success');
    }
}
