<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfessionalProfileRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\Address;
use App\Models\Company;
use App\Models\ProfessionalProfile;
use Illuminate\Http\Request;

class ProfessionalProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $professional_profiles = ProfessionalProfile::where('id_egress', $id)->get();
        return response()->json($professional_profiles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProfessionalProfileRequest $request)
    {
        $address = Address::saveAddress($request);
        $company = Company::select("*")->where("name", $request->name)->where('id_address',$address->id)->first();

        if ($company == null)
            $company_id = (new CompanyController())->store(
                $request)->original['id'];
        else
            $company_id = $company->id;

            $final_date = $request->final_date;
        if (empty($final_date))
        $final_date = null;

        $isFirst = false;
        
        if($request->isFirst != null){
            $isFirst = $request->isFirst;
        }

        $new_professional_profile = ProfessionalProfile::create([
            'id_egress' => $request->id_profile,
            'initial_date' => $request->initial_date,
            'final_date' => $final_date,
            'area' => $request->area_activity,
            'id_company' => $company_id,
            'isFirst' => $isFirst
        ]);

        return response()->json($new_professional_profile);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProfessionalProfileRequest $request)
    {
        $request->validate([
            'id_profile' => 'required',
            'id_company' => 'required',
        ]);

        $this->destroy(
            new Request($request->json()->all())
        );
        $new_profile = $this->store($request)->original;

        return response()->json([
            'message' => 'Professional profile updated successfully',
            'professional_profile' => $new_profile,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:professional_profile,id'
        ]);

        ProfessionalProfile::where('id', $request->id)
        ->delete();

        return response()->json([
            'message' => 'Professional profile successfully deleted',
        ]);
    }

}
