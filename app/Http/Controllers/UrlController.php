<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UrlController extends Controller
{
    public function index()
    {
        $urls = Url::all();
        return view('urls.index', compact('urls'));
    }

    public function create()
    {
        return view('urls.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'url' => 'url|max:2048'
        ]);

        // dd($request);
        $random_string = Str::random(8);
        Url::create([
            'original_url' => $request->url,
            'short_url' => $random_string
        ]);
        return redirect()->action([UrlController::class, 'index']);
    }

    public function edit($id)
    {
        $url = Url::findOrFail($id);
        // dd($url);
        return view('urls.edit', compact('url'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'url' => 'url|max:2048'
        ]);
        // dd($request, $id);
        $url = Url::findOrFail($id);

        // $url->update([
        //     'original_url' => $request->url,
        // ]);

        $url->original_url = $request->url;
        $url->save();

        $request->session()->flash('success', 'Url was updated successfully!');

        return redirect()->action([UrlController::class, 'index']);
    }

    public function destroy(Request $request, $id)
    {
        $url = Url::findOrFail($id);
        $url->delete();
        $request->session()->flash('success', 'Url was deleted successfully!');
        return redirect()->action([UrlController::class, 'index']);
    }

    public function redirect(Request $request, $short_url)
    {
        // dd($short_url);
        // $query = Url::query();
        // $url = $query->where('short_url', $short_url)->first();
        // dd($query);

        $url = Url::where("short_url", $short_url)->first();
        if ($url) {
            return redirect()->away($url->original_url);
        }
        abort(404);
    }
}