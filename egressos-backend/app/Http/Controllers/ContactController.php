<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

/*
 * Don't return json 'cause ContactController will be to EgressController
 */
class ContactController extends Controller
{
    /**
     * Return a listing of contacts.
     */
    public function index(string $id)
    {
        $contacts = Contact::where('id_profile', $id)->get();
        return response()->json($contacts);
    }

    /**
     * Store a newly created contact in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_platform' => 'required|exists:platforms,id',
            'id_profile' => 'required|exists:egresses,id',
            'contact' => 'required|string|unique:contacts, contact'
        ]);

        $stored = Contact::create([
            'id_platform' => $request->id_platform,
            'id_profile' => $request->id_profile,
            'contact' => $request->contact
        ]);
    

        return response()->json($stored);
    }

    /**
     * Update the contact in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'id_platform' => 'required|exists:platforms,id',
            'id_profile' => 'required|exists:egresses,id',
            'contact' => 'required|string|unique:contacts, contact'
        ]);

        $contact = Contact::find($request->contact);
        $contact->contact = $request->contact;
        if (!$contact->save())
            return response()->json(['message' => 'Contact update failed'], 500);

        return response()->json($contact);
    }

    /**
     * Remove the specified contact from storage.
     * In this case contact can be really deleted from storage.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'id_platform' => 'required|exists:platforms,id',
            'id_profile' => 'required|exists:egresses,id',
            'contact' => 'required|string|unique:contacts, contact'
        ]);

        $contact = Contact::find($request->contact);

        if (!$contact->delete())
            return response()->json(['message' => 'Contact delete failed'], 500);

        return response()->json(['message' => 'Contact deleted']);
    }
}
