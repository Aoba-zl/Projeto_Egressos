<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAcademicFormationRequest;
use App\Models\Egress;
use App\Http\Requests\StoreEgressRequest;
use App\Http\Requests\StoreProfessionalProfileRequest;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EgressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        // Define o limite e a página de forma opcional (padrão: 4 itens por página)
        $limit = $request->input('limit', 4);
    
        // Chama o método no model para buscar os dados paginados
        $results = Egress::getEgressWithCompanyAndFeedback($limit);
    
        // Retorna a resposta paginada em formato JSON
        return response()->json($results);
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
            'user_id'   => $user->id,
            'cpf'       => $request->input('cpf'),
            'phone'     => $request->input('phone'),
            'birthdate' => $request->input('birthdate'),
            'status'    => "0"
        ]);

        foreach ($request->contacts as $contactData)
            // TODO: Validar se realmente criou
            (new ContactController)->store(
                new Request([
                    'id_profile'  => $egress     ->id           ,
                    'id_platform' => $contactData['id_platform'],
                    'contact'     => $contactData['contact']    ,
                ])
            );

        foreach ($request->academic_formation as $academicFormationData)
            // TODO: Validar se realmente criou
            (new AcademicFormationController)->store(
                new StoreAcademicFormationRequest([
                    'id_profile'     => $egress               ->id              ,
                    'id_institution' => $academicFormationData['id_institution'],
                    'id_course'      => $academicFormationData['id_course']     ,
                    'begin_year'     => $academicFormationData['begin_year']    ,
                    'end_year'       => $academicFormationData['end_year']      ,
                    'period'         => $academicFormationData['period']
                ])
            );

        foreach ($request->professional_profile as $professionalProfileData)
            // TODO: Validar se realmente criou
            (new ProfessionalProfileController)->store(
                new StoreProfessionalProfileRequest([
                    'id_profile'    => $egress                  ->id            ,
                    'begin_year'    => $professionalProfileData['begin_year']   ,
                    'end_year'      => $professionalProfileData['end_year']     ,
                    'area_activity' => $professionalProfileData['area_activity'],
                    'name'          => $professionalProfileData['name']         ,
                    'phone'         => $professionalProfileData['phone']        ,
                    'site'           => $professionalProfileData['site']          ,
                    'email'         => $professionalProfileData['email']        ,
                    'address'       => $professionalProfileData['address']
                ])
            );

        return response()->json([
            'Message' => 'Egresso cadastrado com sucesso!',
            'Egress' => $egress,
        ]);
    }

    /*
     * Validate that the request meet all classes
     */
    private function validateRequest(Request $request)
    {
        $request->validate((new StoreUserRequest())->rules());
        $request->validate((new StoreEgressRequest())->rules());

        $request->validate([
            'contacts.*.contact' => 'required|string|unique:contacts,contact'
        ]);

        foreach ($request->academic_formation as $academicFormationData)
            Validator::make($academicFormationData, (new StoreAcademicFormationRequest())->rules())->validate();

        foreach ($request->professional_profile as $professionalProfileData)
            Validator::make($professionalProfileData, (new StoreProfessionalProfileRequest())->rules())->validate();

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
    public function searchByName(Request $request)
    {
        $name = $request->input('name');
        $egresses = Egress::getEgressByName($name);

        return response()->json($egresses);
    }
}
