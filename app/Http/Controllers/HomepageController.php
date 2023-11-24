<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomepageController extends Controller
{
    public function index()
    {
        $data = NULL;

        $array = [
            [
                'name' => 'pratik',
                'company' => 'Byte Encoder'
            ],
            [
                'name' => 'saurav',
                'company' => 'Byte Academy'
            ]
        ];

        return view('welcome')
            ->with(['data' => $data, 'array' => $array]);
    }
}
