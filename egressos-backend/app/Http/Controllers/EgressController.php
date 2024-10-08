<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAcademicFormationRequest;
use App\Models\Egress;
use App\Http\Requests\StoreEgressRequest;
use App\Http\Requests\StoreProfessionalProfileRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\Course;
use App\Models\Institution;
use App\Models\User;
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
        $limit = $request->input('limit', 4);  // Quantidade de itens por página, por padrão 4
        $page = $request->input('page', 1);    // Página atual, por padrão 1

        // Chama o método no model para buscar todos os dados
        $results = Egress::getEgressWithCompanyAndFeedback();

        // Converte o resultado para array usando json_encode/json_decode
        $resultsArray = json_decode(json_encode($results), true);

        // Aplica a lógica de paginação manualmente
        $offset = ($page - 1) * $limit;
        $paginatedData = array_slice($resultsArray, $offset, $limit);

        // Cria a resposta paginada manualmente
        $total = count($resultsArray);
        $response = [
            'current_page' => $page,
            'data' => $paginatedData,
            'first_page_url' => url('/api/egresses?page=1'),
            'from' => $offset + 1,
            'last_page' => ceil($total / $limit),
            'last_page_url' => url('/api/egresses?page=' . ceil($total / $limit)),
            'links' => [
                [
                    'url' => $page > 1 ? url('/api/egresses?page=' . ($page - 1)) : null,
                    'label' => '&laquo; Previous',
                    'active' => false,
                ],
                [
                    'url' => url('/api/egresses?page=' . $page),
                    'label' => (string) $page,
                    'active' => true,
                ],
                [
                    'url' => $page < ceil($total / $limit) ? url('/api/egresses?page=' . ($page + 1)) : null,
                    'label' => 'Next &raquo;',
                    'active' => false,
                ],
            ],
            'next_page_url' => $page < ceil($total / $limit) ? url('/api/egresses?page=' . ($page + 1)) : null,
            'path' => url('/api/egresses'),
            'per_page' => $limit,
            'prev_page_url' => $page > 1 ? url('/api/egresses?page=' . ($page - 1)) : null,
            'to' => $offset + count($paginatedData),
            'total' => $total,
        ];

        // Retorna a resposta paginada em formato JSON
        return response()->json($response);
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
        $request->validate([
            'user.user.id' => 'required|integer|exists:users,id'
            ,'cpf' => 'required|string|min:11|max:11'
            ,'phone' => 'required|string|min:8'
            ,'birthdate' => 'required|string|min:8'
        ]);

        $user = User::find($request->user['user']['id']);

        // TODO: Validar se realmente criou
        /*
        $user = (new UserController())->store(
            new StoreUserRequest($request->only(['name', 'email', 'password', 'type_account']))
        )->original['user'];
        */
        
        // TODO: Validar se realmente criou
        
        DB::table('egresses')
            ->where('user_id',$user->id)
            ->delete();
        $egress = Egress::create([
            'user_id'   => $user->id,
            'cpf'       => $request->input('cpf'),
            'phone'     => $request->input('phone'),
            'birthdate' => $request->input('birthdate'),
            'status'    => "0"
        ]);
        
        DB::table('contacts')
            ->where('id_profile',$egress->id)
            ->delete();
        foreach ($request->contacts as $contactData)
            // TODO: Validar se realmente criou
            (new ContactController)->store(
                new Request([
                    'id_profile'  => $egress->id,
                    'id_platform' => $contactData['id_platform'],
                    'contact'     => $contactData['contact'],
                ])
            );

        DB::table('academic_formation')
            ->where('id_profile',$egress->id)
            ->delete();
        foreach ($request->academic_formation as $academicFormationData)
            // TODO: Validar se realmente criou
            
            $institution = 
                Institution::checkAndSave($academicFormationData['institution']);
            

            $course = Course::checkAndSave($academicFormationData['course'],$academicFormationData['type_formation']);

            (new AcademicFormationController)->store(
                new StoreAcademicFormationRequest([
                    'id_profile'     => $egress->id
                    ,'id_institution' => $institution->id
                    ,'id_course'      => $course->id
                    ,'begin_year'     => $academicFormationData['begin_year']    ,
                    'end_year'       => $academicFormationData['end_year']      ,
                    'period'         => $academicFormationData['period']
                ])
            );
            
        DB::table('professional_profile')
            ->where('id_egress',$egress->id)
            ->delete();
        foreach ($request->professional_profile as $professionalProfileData)
            // TODO: Validar se realmente criou
            (new ProfessionalProfileController)->store(
                new StoreProfessionalProfileRequest([
                    'id_profile'    => $egress->id,
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
