<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfessionalProfile extends Model
{
    protected $table = 'professional_profile';

    protected $primaryKey = ['id_company', 'id_egress'];
    public $incrementing = false;

    protected $fillable = [
        'id_company',
        'id_egress',
        'initial_date',
        'final_date',
        'area'
    ];

    // Relacionamento com Company
    public function empresa()
    {
        return $this->belongsTo(Company::class, 'id_company');
    }

    // Relacionamento com Egress
    public function perfilEgresso()
    {
        return $this->belongsTo(Egress::class, 'id_egress');
    }
}
