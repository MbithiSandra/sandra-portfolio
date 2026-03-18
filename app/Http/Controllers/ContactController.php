<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactController extends Controller
{
    // Shows the contact form (GET request)
    public function index()
    {
        return view('contact');
    }

    // Handles the form submission (POST request)
    public function send(Request $request)
    {
        // Step 1 — Validate the incoming data
        // If validation fails, Laravel automatically redirects back
        // with error messages — no extra code needed
        $validated = $request->validate([
            'name'    => 'required|min:2|max:100',
            'email'   => 'required|email',
            'subject' => 'required|min:3|max:150',
            'message' => 'required|min:10|max:2000',
            'type'    => 'required|in:general,booking,collaboration',
        ]);

        // Step 2 — Send the email
        Mail::to('mbithisandra83@gmail.com')
            ->send(new ContactFormMail($validated));

        // Step 3 — Redirect back with a success message
        // withSuccess() flashes a message to the session
        return redirect()->route('contact')
            ->with('success', 'Your message has been sent! I will get back to you soon.');
    }
}