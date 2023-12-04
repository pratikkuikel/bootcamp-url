<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class HomepageController extends Controller
{
    public function index()
    {
        // Log::info('user visited the homepage');
        return view('welcome');
    }

    public function upload_page()
    {
        return view('file');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|image'
        ]);

        $path = $request->file('file')->store();

        return redirect()->back()->with('path',$path);
    }
}
