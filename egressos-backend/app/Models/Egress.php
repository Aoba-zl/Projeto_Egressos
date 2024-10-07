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
        'cpf',
        'phone',
        'birthdate',
        'user_email',
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
    public static function getEgressWithCompanyAndFeedback($perPage = 4)
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
            ->paginate($perPage); // Paginação com 4 registros por página (ou customizável)
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
