<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        'cpf',
        'phone',
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

    /**
     * Método para realizar a busca com joins entre várias tabelas.
     *
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getEgressWithCompanyAndFeedback()
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
                'companies.name as company_name',
                'feedback.comment as feedback_comment'
            )
            ->get(); // Paginação com 4 registros por página (ou customizável)
    }

    public static function getEgressWithCompanyAndFeedbackById($id)
    {
        $egress = Egress::select('*')
            ->join('users', 'users.id', '=', 'egresses.user_id')
            ->where('user_id',$id)
            ->first();

        $egressContacts = Contact::select('*')->where('id_profile',$id)->get();
        $egress->contacts = $egressContacts;

        $egressFeedback = Feedback::select('*')->where('id_profile',$id)->first();
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
            ->where('id_profile',$id)->get();
        $egress->academic_formation = $egressExpAcad;

        $egressExpProf = ProfessionalProfile::select('*')
            ->join('companies', 'companies.id', '=', 'professional_profile.id_company')
            ->where('id_egress',$id)
            ->get();
        $egress->professional_experience = $egressExpProf;

        return $egress;
        /*
        return DB::table('users')
            ->join('egresses', 'egresses.user_id', '=', 'users.id')
            ->join('professional_profile', 'professional_profile.id_egress', '=', 'egresses.id')
            ->join('companies', 'companies.id', '=', 'professional_profile.id_company')
            ->join('addresses', 'addresses.id', '=', 'companies.id_address')
            ->leftJoin('feedback', 'feedback.id_profile', '=', 'egresses.id')
            ->select(
                'users.id as user_id',
                'users.name as user_name',
                'companies.name as company_name',
                'feedback.comment as feedback_comment'
            )
            ->where('user_id',$id)
            ->first();
        */
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
                'users.id as user_id',
                'users.name as user_name',
                'companies.name as company_name',
                'feedback.comment as feedback_comment'
            )
            ->where('users.name', 'LIKE', '%' . $name . '%') // Busca pelo nome, utilizando LIKE para parcial match
            ->paginate($perPage); // Paginação com 4 registros por página (ou customizável)
    }
}
