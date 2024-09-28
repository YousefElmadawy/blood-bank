<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts =Contact::latest()->paginate(5);
        return view('admin.contactUs.index',compact('contacts'));
    }

    public function show(Contact $contact)
    {
        //
    }

    public function destroy(Contact $contact)
    {
        //
    }
}
