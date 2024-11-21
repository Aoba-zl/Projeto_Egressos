<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAcademicFormationRequest;
use App\Http\Requests\StoreContactRequest;
use App\Models\Egress;
use App\Http\Requests\StoreEgressRequest;
use App\Http\Requests\StoreUpdateEgressRequest;
use App\Http\Requests\StoreProfessionalProfileRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\Course;
use App\Models\Feedback;
use App\Models\Institution;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
    public function store(Request $request)
    {
        // Decodifica o formdata
        $request = $this->decodeEgressRequest($request);
        // Valida todos os dados antes de criar qualquer entrada no banco
        $this->validateRequest($request);


        // TODO: Validar se realmente criou
        $user = (new UserController())->store(
            new StoreUserRequest($request->user)
        )->original['user'];

        // TODO: Validar se realmente criou
        // responsabilidade de armazenar os dados do egresso passados para model.
        $egress = Egress::saveEgress($request, $user->id);
        $this->storeEgressInfos($request,$egress);

        return response()->json([
            'message' => 'Egresso cadastrado com sucesso!',
            'egress' => $egress,
        ]);
    }

    public function storeEgressInfos(Request $request,Egress $egress){
        foreach ($request->contacts as $contactData)
        // TODO: Validar se realmente criou
        (new ContactController)->store(
            new StoreContactRequest([
                'id_profile'  => $egress->id,
                'id_platform' => $contactData['id_platform'],
                'contact'     => $contactData['contact'],
            ])
        );
        $firstFormation = true;
        foreach ($request->academic_formation as $academicFormationData)
            // TODO: Validar se realmente criou
            if($firstFormation){
                (new AcademicFormationController)->store(
                    new StoreAcademicFormationRequest([
                        'id_profile'     => $egress->id,
                        'institution'    => $academicFormationData['institution'],
                        'course'         => $academicFormationData['course'],
                        'begin_year'     => $academicFormationData['begin_year'],
                        'end_year'       => $academicFormationData['end_year'],
                        'period'         => $academicFormationData['period'],
                        'isFirst'        => '1'
                    ])
                );
                $firstFormation = false;
            }else{
                (new AcademicFormationController)->store(
                    new StoreAcademicFormationRequest([
                        'id_profile'     => $egress->id,
                        'institution'    => $academicFormationData['institution'],
                        'course'         => $academicFormationData['course'],
                        'begin_year'     => $academicFormationData['begin_year'],
                        'end_year'       => $academicFormationData['end_year'],
                        'period'         => $academicFormationData['period']
                    ])
                );
            }
        $firstFormation = true;
        foreach ($request->professional_profile as $professionalProfileData)
            // TODO: Validar se realmente criou
            if($firstFormation){
                (new ProfessionalProfileController)->store(
                    new StoreProfessionalProfileRequest([
                        'id_profile'    => $egress->id,
                        'initial_date'    => $professionalProfileData['initial_date']   ,
                        'final_date'      => $professionalProfileData['final_date']     ,
                        'area_activity' => $professionalProfileData['area_activity'],
                        'name'          => $professionalProfileData['name']         ,
                        'phone'         => $professionalProfileData['phone']        ,
                        'site'           => $professionalProfileData['site']          ,
                        'email'         => $professionalProfileData['email']        ,
                        'address'       => $professionalProfileData['address'],
                        'isFirst'        => '1'
                    ])
                );
                $firstFormation = false;
            }else{
                (new ProfessionalProfileController)->store(
                    new StoreProfessionalProfileRequest([
                        'id_profile'    => $egress->id,
                        'initial_date'    => $professionalProfileData['initial_date']   ,
                        'final_date'      => $professionalProfileData['final_date']     ,
                        'area_activity' => $professionalProfileData['area_activity'],
                        'name'          => $professionalProfileData['name']         ,
                        'phone'         => $professionalProfileData['phone']        ,
                        'site'           => $professionalProfileData['site']          ,
                        'email'         => $professionalProfileData['email']        ,
                        'address'       => $professionalProfileData['address']
                    ])
                );
            }

            //Salvar feedback
            $storedFeedback = Feedback::create([
                "id_profile"=>$egress->id
                ,"comment"=>$request->feedback]);
    }
    /*
     * Validate that the request meet all classes
     */
    private function validateRequest(Request $request)
    {
        Validator::make($request->user, (new StoreUserRequest())->rules())->validate();
        $request->validate((new StoreEgressRequest())->rules());

        $request->validate([
            'contacts.*.contact' => 'required|string|unique:contacts,contact'
        ]);

        // TODO: Diferenciar a principal das demais
        foreach ($request->academic_formation as $academicFormationData)
            Validator::make($academicFormationData, (new StoreAcademicFormationRequest())->rules())->validate();

        // TODO: Diferenciar a principal das demais
        foreach ($request->professional_profile as $professionalProfileData)
            Validator::make($professionalProfileData, (new StoreProfessionalProfileRequest())->rules())->validate();

    }

    private function decodeEgressRequest(Request $request)
    {
        $decoded_user       = json_decode($request->user, true);
        $decoded_contacts   = json_decode($request->contacts, true);
        $decoded_formations = json_decode($request->academic_formation, true);
        $decoded_profiles   = json_decode($request->professional_profile, true);

        $request->merge([
            'user'                 => $decoded_user,
            'contacts'             => $decoded_contacts,
            'academic_formation'   => $decoded_formations,
            'professional_profile' => $decoded_profiles,
        ]);

        return $request;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $egress = Egress::getEgressWithCompanyAndFeedbackById($id);
        if($egress != null){
            return response()->json($egress);
        }else{
            return response()->json("not found",404);
        }
    }

    public function showAdmin(string $id,$user_token)
    {
        $user = User::getUserByToken($user_token);
        if($user != null && ($user->id == $id || $user->type_account != 0) ){
            $egress = Egress::getEgressWithCompanyAndFeedbackByIdAdmin($id);
            return response()->json($egress);
        }else{
            return response()->json(["message" => "Unauthorized"],403);
        }
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
    public function update(Request $request)
    {
        $request = $this->decodeEgressRequest($request);

        $request->validate((new StoreUpdateEgressRequest())->rules());

        // Como apagar dados antes de atualizar
        DB::table('professional_profile')
            ->where('id_egress',$request->id)
            ->delete();

        DB::table('academic_formation')
            ->where('id_profile',$request->id)
            ->delete();

        DB::table('contacts')
            ->where('id_profile',$request->id)
            ->delete();

        DB::table('feedback')
            ->where('id_profile',$request->id)
            ->delete();

        $egress = Egress::find($request->id);

        // Salva a imagem no storage
        $old_image_path = $egress->imagePath;

        try
        {
            $new_image_path = Egress::saveImage($request->file('image'));
        }
        catch (Exception $e)
        {
            $new_image_path = Egress::saveImage(null);
        }

        // Atualiza o caminho na tabela do egresso

        $isPhonePublic = ($request->input('isPhonePublic') === 'true'); //Evita o erro no formdata

        $egress->where('id',$egress->id)
        ->update([
            'cpf'=>$request->cpf,
            'imagePath' =>$new_image_path,
            'phone'=>$request->phone,
            'birthdate'=>$request->birthdate,
            'phone_is_public'=>$isPhonePublic,
            'status'=>'0']);

        foreach ($request->academic_formation as $academicFormationData)
            Validator::make($academicFormationData, (new StoreAcademicFormationRequest())->rules())->validate();

        foreach ($request->professional_profile as $professionalProfileData)
            Validator::make($professionalProfileData, (new StoreProfessionalProfileRequest())->rules())->validate();


        // Apaga a imagem antiga do storage
        Storage::delete($old_image_path);

        $result = $this->storeEgressInfos($request,$egress);

        return response()->json([
            'message' => 'Egresso editado com sucesso!'
        ]);
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

    public function searchByNameAndStatus(Request $request)
    {
        $name = $request->input('name');
        $status = $request->input('status');

        $egresses = Egress::getEgressByNameAndStatus($name,$status);

        return response()->json($egresses);
    }

    public function getRandom(){
        $egresses = Egress::getRandom();
        return response()->json($egresses);
    }

    public function getAprovedReprovedEgresses(Request $request){
         // Captura o status do request
         $status = $request->input('status');

         // Chama o método na model Egress para obter os dados
         $egresses = Egress::getApprovedReprovedEgresses($status);

         return response()->json($egresses);
    }

    public function getEgressesUnderAnalysis(Request $request){
        $perPage = $request->input('limit', 20);
        $egresses = Egress::getEgressesUnderAnalysis($perPage);

        return response()->json($egresses);
    }
}
