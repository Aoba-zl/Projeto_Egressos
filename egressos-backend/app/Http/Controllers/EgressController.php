<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAcademicFormationRequest;
use App\Models\Egress;
use App\Http\Requests\StoreEgressRequest;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $this->validateRequest($request);

        // TODO: Validar se realmente criou
        $user = (new UserController())->store(
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
            (new ContactController)->store(
                new Request([
                    'id_profile' => $egress->id,
                    'id_platform' => $contactData['id_platform'],
                    'contact' => $contactData['contact'],
                ])
            );

        foreach ($request->academic_formation as $academicFormationData)
            // TODO: Validar se realmente criou
            (new AcademicFormationController)->store(
                new StoreAcademicFormationRequest([
                    'id_profile' => $egress->id,
                    'id_institution' => $academicFormationData['id_institution'],
                    'id_course' => $academicFormationData['id_course'],
                    'begin_year' => $academicFormationData['begin_year'],
                    'end_year' => $academicFormationData['end_year'],
                    'period' => $academicFormationData['period'],
                ])
            );

        /*
        foreach ($request->professional_profile as $professionalProfileData)
            // TODO: Validar se realmente criou
            (new ProfessionalProfileController)->store(
                new Request($professionalProfileData)
            );
        */

        return response()->json([
            'Message' => 'Egresso cadastrado com sucesso!',
            'Egress' => $egress,
        ]);
    }

    /*
     * Validate that the request meet all classes
     * // TODO: Gambiarra pra criar nenhuma entrada no banco
     */
    private function validateRequest(Request $request)
    {
        $request->validate((new StoreUserRequest())->rules());
        $request->validate((new StoreEgressRequest())->rules());

        /*
         * TODO: Validar contato.
         * se a plataforma não existir tem q ser criada. no momento ela é chumbada no banco
         * garantir que o contato é unique. mas tem q existir um egresso pra isso....

        foreach ($request->contacts as $contactData)
            Validator::make($contactData, (new StoreContactRequest())->rules())->validate();

         */

        /*
         * No momento as instituições são chumbadas.
         */
        foreach ($request->academic_formation as $academicFormationData)
            Validator::make($academicFormationData, (new StoreAcademicFormationRequest())->rules())->validate();

        // TODO: foreach ($request->professional_profile as $professionalProfileData)

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