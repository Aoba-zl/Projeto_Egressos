<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::paginate(50);
        return response()->json($companies);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string"
            ,"email" => "required|string|email"
            ,"phone" => "required|string"
            ,"address.cep" => "required|string|min:8|max:8"
            ,"address.num_porta" => "required|numeric"
        ]);


        $address = Address::saveAddress($request);

        $storedCompany = Company::create([
            "name" => $request->name 
            , "email" => $request->email 
            , "phone" => $request->phone 
            , "site" => $request->site 
            , "id_address" => $address->id
        ]);

        return response()->json($storedCompany);
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
    // Faz sentido ser apenas para moderador ou admin ?
    public function update(Request $request)
    {
        $request->validate([
            "id" => "required|numeric"
            ,"name" => "required|string"
            ,"email" => "required|string|email"
            ,"phone" => "required|string"
            ,"address.cep" => "required|string|min:8|max:8"
            ,"address.num_porta" => "required|numeric"
        ]);


        $address = Address::saveAddress($request);

        $companyToUpdate = Company::find($request->id);
        $companyToUpdate->name = $request->name;
        $companyToUpdate->email = $request->email;
        $companyToUpdate->phone = $request->phone;
        $companyToUpdate->site = $request->site;
        $companyToUpdate->id_address = $address->id;

        $companyToUpdate->save();
        return response()->json(['message'=>'Company updated with success','company'=>$companyToUpdate]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
