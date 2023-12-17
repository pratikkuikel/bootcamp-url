<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class TestException extends Exception
{
    public function report()
    {
        // Log::info('I occured');
        // notify in slack, discord, mail
    }

    public function render(Request $request)
    {
       abort(404);
    }
}
