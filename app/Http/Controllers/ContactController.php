<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function contact()
    {
        return Inertia::render('User/contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'nullable|email',
            'phone' => 'required|string|min:10|max:15',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create($validated);

        return redirect()->back()->with('success', 'Thank you for your message!');
    }
}
