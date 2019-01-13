<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadsController extends Controller
{
    public function store(Request $request)
    {
        $file = $request->file('file');
        $path = Storage::put('public/properties', $request->file('file'));

        return ['status' => 200, 'url' => Storage::url($path)];
    }
}
