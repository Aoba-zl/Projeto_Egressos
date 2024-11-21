<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\UrlGeneration\PublicUrlGenerator;
use stdClass;

class Egress extends Model
{
    use HasFactory;

    /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'imagePath',
        'cpf',
        'phone',
        'phone_is_public',
        'birthdate',
        'status'
    ];

    /**
     * Os atributos que devem ser mutados para tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'birthdate' => 'date',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_email', 'email');
    }

    public static function saveImage($image_file)
    {
        $image_path = 'uploads/default.jpg';

        if ($image_file != null)
        {
            $image_name = rand(0, 9999999999) . $image_file->getClientOriginalName();
            $image_path = $image_file->storeAs('uploads', $image_name);
        }

        return $image_path;
    }

    public static function saveEgress(Request $request, $user_id)
    {
        $image_path = self::saveImage($request->file('image'));

        $isPhonePublic = ($request->input('isPhonePublic') === 'true');

        $new_egress = Egress::create([
            'user_id'         => $user_id,
            'imagePath'       => $image_path,
            'cpf'             => $request->input('cpf'),
            'phone'           => $request->input('phone'),
            'phone_is_public' => $isPhonePublic,
            'birthdate'       => $request->input('birthdate'),
            'status'          => config('constants.STATUS_IN_ANALISYS')
        ]);

        return $new_egress;
    }

    /**
     * Método para realizar a busca com joins entre várias tabelas.
     *
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getEgressWithCompanyAndFeedback($limit)
    {
        return DB::table('users')
            ->join('egresses', 'egresses.user_id', '=', 'users.id')
            ->join('professional_profile', 'professional_profile.id_egress', '=', 'egresses.id')
            ->join('companies', 'companies.id', '=', 'professional_profile.id_company')
            ->join('addresses', 'addresses.id', '=', 'companies.id_address')
            ->leftJoin('feedback', 'feedback.id_profile', '=', 'egresses.id')
            ->select(
                'users.id as user_id',
                'users.name as user_name',
                'egresses.imagePath as image_path',
                'companies.name as company_name',
                'feedback.comment as feedback_comment'
            )
            ->whereRaw('
                professional_profile.initial_date in (
                select distinct max(initial_date) maxD
                from professional_profile
                group by id_egress)
            ')
            ->where('egresses.status','1')
            ->where('isFirst',1)
            ->paginate($limit); // Pagina automaticamente conforme o limite informado
    }

    public static function getEgressWithCompanyAndFeedbackById($id)
    {
        $egress = Egress::select(
            'egresses.id'
            ,'egresses.imagePath as image_path'
            ,'egresses.birthdate'
            ,'egresses.cpf'
            ,'egresses.phone'
            ,'egresses.phone_is_public'
            ,'users.id AS user_id'
            ,'users.email'
            ,'users.name'
            ,'egresses.status as status'
            )
            ->join('users', 'users.id', '=', 'egresses.user_id')
            ->where('user_id',$id)
            ->first();

        $egressContacts = Contact::select([ 'platforms.id as id_platform',
        'platforms.name as name_platform',
        'contacts.contact as contact'])
            ->join('platforms', 'contacts.id_platform', '=', 'platforms.id')
            ->where('id_profile',$egress->id)
            ->get();
        $egress->contacts = $egressContacts;

        if($egress->phone_is_public){
            $egressPhone = new stdClass();
            $egressPhone->name_platform = "Telefone";
            $egressPhone->contact = $egress->phone;

            $egress->contacts->push($egressPhone);
        }

        unset($egress->phone);
        unset($egress->phone_is_public);

        $egressFeedback = Feedback::select('*')
            ->where('id_profile',$egress->id)
            ->first();

        $egress->feedback = $egressFeedback;

        $egressExpAcad = AcademicFormation::
            select(
                'academic_formation.begin_year'
                ,'academic_formation.end_year'
                ,'academic_formation.period'
                ,'institutions.name as institution_name'
                ,'academic_formation.id_course AS course_id'
                ,'courses.name as course_name'
                ,'courses.type_formation as course_type_formation'
                )
            ->join('institutions', 'academic_formation.id_institution', '=', 'institutions.id')
            ->join('courses', 'academic_formation.id_course', '=', 'courses.id')
            ->where('id_profile',$egress->id)->get();
        $egress->academic_formation = $egressExpAcad;

        $egressExpProf = ProfessionalProfile::select('*')
            ->join('companies', 'companies.id', '=', 'professional_profile.id_company')
            ->join('addresses','addresses.id','=','companies.id_address')
            ->where('id_egress',$egress->id)
            ->get();
        $egress->professional_experience = $egressExpProf;

        return $egress;
    }

    public static function getEgressWithCompanyAndFeedbackByIdAdmin($id)
    {
        $egress = Egress::select(
            'egresses.id'
            ,'egresses.imagePath as image_path'
            ,'egresses.birthdate'
            ,'egresses.phone'
            ,'egresses.cpf'
            ,'egresses.phone_is_public'
            ,'users.id AS user_id'
            ,'users.email'
            ,'users.name'
            ,'egresses.status as status'
            )
            ->join('users', 'users.id', '=', 'egresses.user_id')
            ->where('user_id',$id)
            ->first();

        $egressContacts = Contact::select([
            'platforms.id as id_platform',
            'platforms.name as name_platform',
            'contacts.contact as contact'
            ])
            ->join('platforms', 'contacts.id_platform', '=', 'platforms.id')
            ->where('id_profile',$egress->id)
            ->get();
        $egress->contacts = $egressContacts;


        $egressPhone = new stdClass();
        $egressPhone->name_platform = "Telefone";
        $egressPhone->contact = $egress->phone;

        $egress->contacts->push($egressPhone);

        $egressFeedback = Feedback::select('*')
            ->where('id_profile',$egress->id)
            ->first();

        $egress->feedback = $egressFeedback;

        $egressExpAcad = AcademicFormation::
            select(
                'academic_formation.begin_year'
                ,'academic_formation.end_year'
                ,'academic_formation.period'
                ,'institutions.name as institution_name'
                ,'academic_formation.id_course AS course_id'
                ,'courses.name as course_name'
                ,'courses.type_formation as course_type_formation'
                )
            ->join('institutions', 'academic_formation.id_institution', '=', 'institutions.id')
            ->join('courses', 'academic_formation.id_course', '=', 'courses.id')
            ->where('id_profile',$egress->id)->get();
        $egress->academic_formation = $egressExpAcad;

        $egressExpProf = ProfessionalProfile::select('*')
            ->join('companies', 'companies.id', '=', 'professional_profile.id_company')
            ->join('addresses','addresses.id','=','companies.id_address')
            ->where('id_egress',$egress->id)
            ->get();
        $egress->professional_experience = $egressExpProf;

        return $egress;
    }

    public static function getRandom()
    {
        $egresses = User::inRandomOrder()
        ->join('egresses', 'egresses.user_id', '=', 'users.id')
            ->join('academic_formation', 'academic_formation.id_profile', '=', 'egresses.id')
            ->join('courses', 'courses.id', '=', 'academic_formation.id_course')
            ->leftJoin('feedback', 'feedback.id_profile', '=', 'egresses.id')
            ->select(
                'users.id as user_id',
                'users.name as user_name',
                'egresses.imagePath as image_path',
                'courses.name as course_name',
                'feedback.comment as feedback_comment'
            )
            ->where('isFirst',1)
            ->where('egresses.status','1')
            ->limit(3)
            ->get();
            return $egresses;
    }

    /**
     * Método para buscar egressos pelo nome do usuário.
     *
     * @param string $name
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getEgressByName($name, $perPage = 4)
    {
        return DB::table('users')
            ->join('egresses', 'egresses.user_id', '=', 'users.id')
            ->join('professional_profile', 'professional_profile.id_egress', '=', 'egresses.id')
            ->join('companies', 'companies.id', '=', 'professional_profile.id_company')
            ->join('addresses', 'addresses.id', '=', 'companies.id_address')
            ->leftJoin('feedback', 'feedback.id_profile', '=', 'egresses.id')
            ->select(
                'users.id as user_id'
                ,'users.name as user_name'
                ,'companies.name as company_name'
                ,'feedback.comment as feedback_comment'
                ,'egresses.imagePath as image_path'
            )
            ->where('users.name', 'LIKE', '%' . $name . '%') // Busca pelo nome, utilizando LIKE para parcial match
            ->where('isFirst',1)
            ->where('egresses.status','1')
            ->paginate($perPage); // Paginação com 4 registros por página (ou customizável)
    }

    public static function getEgressByNameAndStatus($name, $status, $perPage = 20)
    {
        return DB::table('users')
            ->join('egresses', 'egresses.user_id', '=', 'users.id')
            ->join('academic_formation','egresses.id','=','academic_formation.id_profile')
            ->join('courses','courses.id','=','academic_formation.id_course')
            ->select(
                'users.id as id'
                ,'egresses.imagepath as image_path'
                ,'users.name as name'
                ,'courses.name as course'
                ,'egresses.status as status'
            )
            ->where('users.name', 'LIKE', '%' . $name . '%') // Busca pelo nome, utilizando LIKE para parcial match
            ->where('egresses.status',$status)
            ->where('isFirst',1)
            ->paginate($perPage); // Paginação com 4 registros por página (ou customizável)
    }

    // Método para obter os egressos aprovados ou reprovados com base no status
    public static function getApprovedReprovedEgresses($status)
    {
        return Egress::
        select(
            'u.id as id'
            ,'egresses.imagepath as image_path'
            ,'u.name as name'
            ,'courses.name as course'
            ,'egresses.status as status'
        )
        ->join('users as u', 'u.id', '=', 'egresses.user_id')
        ->join('academic_formation','egresses.id','=','academic_formation.id_profile')
        ->join('courses','courses.id','=','academic_formation.id_course')
        ->where('egresses.status', '=', $status)
        ->whereNotIn('u.type_account', ['1', '2'])
        ->where('isFirst',1)
        ->orderBy('egresses.created_at','ASC')
        ->paginate(20);
    }

    /*
    public static function getApprovedReprovedEgresses($status)
    {
        return self::join('users as u', 'u.id', '=', 'egresses.user_id')
            ->join('assessments', 'assessments.id_egress', '=', 'egresses.id')
            ->join('users as us', 'us.id', '=', 'assessments.id_moderator_admi')
            ->select('u.name as user_name', 'u.id as user_id', 'egresses.user_id as egress_id', 'us.name as moderator_name', 'egresses.status')
            ->where('egresses.status', '=', $status)
            ->whereNotIn('u.type_account', ['1', '2'])
            ->get();
    }
    */

    public static function getEgressesUnderAnalysis($perPage){
        return Egress::
            select(
                'users.id as id'
                ,'egresses.imagepath as image_path'
                ,'users.name as name'
                ,'courses.name as course'
                ,'egresses.status as status'
            )
            ->join('users','users.id','=','egresses.user_id')
            ->join('academic_formation','egresses.id','=','academic_formation.id_profile')
            ->join('courses','courses.id','=','academic_formation.id_course')
            ->where('egresses.status','0')
            ->whereRaw(
                '
                    academic_formation.begin_year in (
                    select distinct max(begin_year) maxD
                    from academic_formation
                    group by id_profile)
                '
            )
            ->where('isFirst',1)
            ->orderBy('egresses.created_at','ASC')
            ->paginate(20);
    }
}
