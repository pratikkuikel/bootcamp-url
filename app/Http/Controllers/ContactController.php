<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController
{

    public function index()
    {
        // name, email, message

        // $contacts = Contact::first();

        // $contact = new Contact();
        // $contact->name = 'abinash';
        // $contact->email = 'abinash@gmail.com';
        // $contact->message = 'Hello it\'s me';
        // $contact->save();

        // Contact::create([
        //     'name' => 'byte academy',
        //     'email' => 'byteacademy007@gmail.com',
        //     'message' => 'hello'
        // ]);

        // $contacts = Contact::all();

        // dd($contacts);


        // $collection = collect(
        //     [1, 2, 3]
        // );
        return view('contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string'
        ]);

        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ]);

        return redirect()->back()->with('success','Thank you for contacting us !');
    }
}
