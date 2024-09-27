<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Institution;
use Illuminate\Http\Request;

class InstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $institutions = Institution::paginate(50);
        return response()->json($institutions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $storedInstitution = Institution::checkAndSaveInstitution($request);

        return response()->json(["message" => "Institution created with success", "institution" => $storedInstitution]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            "id" => "required|numeric|exists:institutions,id"
            ,"name" => "required|string"
            ,"address.cep" => "required|string|min:8|max:8"
            ,"address.num_porta" => "required|numeric"
        ]);

        $address = Address::saveAddress($request);

        $institutionToUpdate = Institution::find($request->id);
        $institutionToUpdate->name = $request->name;
        $institutionToUpdate->id_address = $address->id;
        $institutionToUpdate->save();

        return response()->json(["message" => "Institution updated with success", "institution" => $institutionToUpdate]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            "id" => "required|numeric|exists:institutions,id"
        ]);

        $institutionToDelete = Institution::find($request->id);
        $institutionToDelete->delete();

        return response()->json(["message" => "Institution deleted with success", "institution" => $institutionToDelete]);
    }
}
