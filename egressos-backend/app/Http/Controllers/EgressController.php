<?php

namespace App\Http\Controllers;

use App\Models\AcademicFormation;
use App\Models\Contact;
use App\Models\Egress;
use App\Models\ProfessionalProfile;
use App\Http\Controllers\UserController;
use App\Http\Requests\StoreEgressRequest;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EgressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $egresses = Egress::all();
        return response()->json($egresses);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEgressRequest $request)
    {
        $userController = new UserController;
        $contactController = new ContactController;
        $academicFormationController = new AcademicFormationController;
        $professionalProfileController = new ProfessionalProfileController;


        $user = $this->validateUser($userController->store(
            new StoreUserRequest($request->only(['name', 'email', 'password', 'type_account']))
        ));

        $egress = Egress::create([
            'user_id' => $user->id,
            'cpf' => $request->input('cpf'),
            'phone' => $request->input('phone'),
            'birthdate' => $request->input('birthdate'),
            'status' => "0"
        ]);

        /*
        foreach ($request->contats as $contactData)
            // TODO: Validar
            $contact = $contactController->store(
                new Request($contactData)
            );
        */

        /*
        foreach ($request->academic_formation as $academicFormationData)
            // TODO: Validar
            $academicFormation = $academicFormationController->store(
                new Request($academicFormationData)
            );
        */

        /*
        foreach ($request->professional_profile as $professionalProfileData)
            // TODO: Validar
            $professionalProfile = $professionalProfileController->store(
                new Request($professionalProfileData)
            );
        */

        return response()->json($egress);
    }

    private function validateUser(JsonResponse $userJson)
    {
        $user = $userJson->original['user'];
        // TODO: Validar
        return $user;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $egress = Egress::where('id', $id)->get();
        return response()->json($egress);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
