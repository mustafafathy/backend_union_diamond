<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'message' => 'required|string',
        ]);

        Contact::create($data);

        return response('Your request submited succefuly.');
    }

    public function read(Contact $contact)
    {
        $contact->is_read = true;
        $contact->save();
        return back();
    }
}
