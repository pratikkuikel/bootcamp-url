<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        $path = $request->file('file')->store('public');

        // $qualified_url = Storage::url($path);

        // dd($path,$qualified_url);

        return redirect()->back()->with('path',$path);
    }
}
