<?php

namespace App\Http\Controllers;

use App\Models\Url;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class UrlController extends Controller
{
    public function index()
    {
        // $urls = Url::all();
        // get urls created by currently authenticated user
        // $urls = auth()->user()->urls;
        // $userId = auth()->user()->id;
        // $urls = Url::where('user_id', $userId)->get();
        $user = auth()->user();
        Log::error($user);
        $urls = $user->urls;
        return view('urls.index', compact('urls'));
    }

    public function view($id)
    {
        $url = Url::findOrFail($id);
        if ($url->user_id != auth()->id()) {
            abort(401);
        }
        return view('urls.view', compact('url'));
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
            'user_id' => auth()->user()->id,
            // 'user_id' => auth()->id(),
            'original_url' => $request->url,
            'short_url' => $random_string
        ]);
        return redirect()->action([UrlController::class, 'index']);
    }

    public function edit($id)
    {
        // $user_id = auth()->id();
        // $query = Url::where('user_id', $user_id)
        //     ->where('id', $id)->first();
        // if (!$query) {
        //     abort(401);
        // }
        $url = Url::findOrFail($id);
        if ($url->user_id != auth()->id()) {
            abort(401);
        }
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

        if ($url->user_id != auth()->id()) {
            abort(401);
        }

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
        if ($url->user_id != auth()->id()) {
            abort(401);
        }
        $url->delete();
        $request->session()->flash('success', 'Url was deleted successfully!');
        return redirect()->action([UrlController::class, 'index']);
    }

    public function redirect(Request $request, $short_url)
    {
        // dd($request->userAgent());
        // dd($short_url);
        // $query = Url::query();
        // $url = $query->where('short_url', $short_url)->first();
        // dd($query);

        $url = Url::where("short_url", $short_url)->first();
        if ($url) {
            // record ip and user agent
            Visitor::create([
                'url_id' => $url->id,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);
            // $url->visitor_count++;
            // $url->save();
            // increment visitor count
            $url->increment('visitor_count');
            return redirect()->away($url->original_url);
        }
        abort(404);
    }
}
