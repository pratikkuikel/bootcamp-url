<?php

namespace App\Http\Controllers;

use App\Models\Url;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\CreateUrlRequest;
use App\Http\Requests\UpdateUrlRequest;
use App\Events\UrlCreation;
use App\Jobs\SendUrlCreatedMailJob;
use App\Mail\UrlCreatedMail;
use App\Mail\UrlCreatedMarkdownMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;

class UrlController extends Controller
{
    public function index()
    {
        // $value = Cache::set('key','hello');
        // dd(Cache::get('key'));
        // abort(404);
        // $urls = Url::all();
        // get urls created by currently authenticated user
        // $urls = auth()->user()->urls;
        // $userId = auth()->user()->id;
        // $urls = Url::where('user_id', $userId)->get();
        // Log::error($user);


        // if there is no urls key in cache fetch urls from the database
        // fetch urls from database and set the urls key
        // else fetch the urls from cache and return it


        // if (Cache::has('urls')) {
        //     Log::info('urls present');
        //     $urls =  Cache::get('urls');
        //     Cache::forget('urls');
        //     return $urls;
        // } else {
        //     Log::info('urls not present in the cache');
        //     $urls = Url::where('user_id', $user_id)->get();
        //     Cache::set('urls', $urls);
        //     return Cache::get('urls');
        // }
        $user_id = auth()->id();

        $urls = Cache::remember('urls', 600, function () use ($user_id) {
            return Url::where('user_id', $user_id)->paginate(50);
        });

        $count = Url::where('user_id', $user_id)->count();
        return view('urls.index', compact('urls', 'count'));
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

    public function store(CreateUrlRequest $request)
    {
        // $request->validate([
        //     'url' => 'url|max:2048'
        // ]);

        // dd($request);
        $random_string = Str::random(8);
        $url = Url::create([
            // 'user_id' => auth()->user()->id,
            // 'user_id' => auth()->id(),
            'original_url' => $request->url,
            'short_url' => $random_string
        ]);
        $user = auth()->user();
        // Mail::to($user)->send(new UrlCreatedMail($url));
        // Mail::to($user)->send(new UrlCreatedMarkdownMail($url));
        // UrlCreation::dispatch($url);
        SendUrlCreatedMailJob::dispatch($user, $url);
        return redirect()->action([UrlController::class, 'index']);
    }

    public function edit(UpdateUrlRequest $request, $id)
    {
        // $user_id = auth()->id();
        // $query = Url::where('user_id', $user_id)
        //     ->where('id', $id)->first();
        // if (!$query) {
        //     abort(401);
        // }
        $url = Url::findOrFail($id);
        // dd($url);
        return view('urls.edit', compact('url'));
    }

    public function update(UpdateUrlRequest $request, $id)
    {
        // dd($request, $id);
        $url = Url::findOrFail($id);
        // $url->update([
        //     'original_url' => $request->url,
        // ]);

        $url->original_url = $request->url;
        $url->save();

        Cache::forget('urls');

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
        Cache::forget('urls');
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
