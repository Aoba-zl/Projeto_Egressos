<?php

namespace App\Http\Controllers;

use App\Models\Egress;
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
    public function store(Request $request) // TODO: StoreEgressRequest valida, mas é preciso resolver as validações.
    {
        $userController = new UserController;
        $contactController = new ContactController;
        $academicFormationController = new AcademicFormationController;
        $professionalProfileController = new ProfessionalProfileController;

        $this->validateRequest($request);


        // TODO: Validar se realmente criou
        $user = $userController->store(
            new StoreUserRequest($request->only(['name', 'email', 'password', 'type_account']))
        )->original['user'];

        // TODO: Validar se realmente criou
        $egress = Egress::create([
            'user_id' => $user->id,
            'cpf' => $request->input('cpf'),
            'phone' => $request->input('phone'),
            'birthdate' => $request->input('birthdate'),
            'status' => "0"
        ]);

        foreach ($request->contacts as $contactData)
            // TODO: Validar se realmente criou
            $contact = $contactController->store(
                new Request([
                    'id_profile' => $egress->id,
                    'id_platform' => $contactData['platform'],
                    'contact' => $contactData['contact'],
                ])
            );

        /*
        foreach ($request->academic_formation as $academicFormationData)
            // TODO: Validar se realmente criou
            $academicFormation = $academicFormationController->store(
                new Request($academicFormationData)
            );
        */

        /*
        foreach ($request->professional_profile as $professionalProfileData)
            // TODO: Validar se realmente criou
            $professionalProfile = $professionalProfileController->store(
                new Request($professionalProfileData)
            );
        */

        return response()->json($egress);
    }

    /*
     * Validate that the request meet all classes
     * // TODO: Gambiarra
     */
    private function validateRequest(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-ZÀ-ú\s]+$/'],
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'string', 'min:8', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'],
            'type_account' => 'required|in:0,1,2',
        ]);

        $request->validate([
            'cpf' => ['required', 'cpf', 'digits:11', 'unique:egresses,cpf'],
            'phone' => ['required', 'digits:11'],
            'birthdate' => ['required', 'date', 'before:01-01-' . now()->year, 'after:01/01/1900']
        ]);

        $request->validate([
            'contacts.*.platform' => 'required|exists:platforms,id',
            'contacts.*.contact' => 'required|string|unique:contacts,contact'
        ]);
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
    public function disable(string $id)
    {
        //
    }
}
