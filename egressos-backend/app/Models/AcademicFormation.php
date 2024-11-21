<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicFormation extends Model
{
    protected $table = 'academic_formation';

    protected $primaryKey = ['id_egress', 'id_institution', 'id_cours'];
    public $incrementing = false;

    protected $fillable = [
        'id_profile',
        'id_institution',
        'id_course',
        'begin_year',
        'end_year',
        'period',
        'isFirst'
    ];

    // Relacionamento com Perfil_Egresso
    public function perfilEgresso()
    {
        return $this->belongsTo(Egress::class, 'id_egress');
    }

    // Relacionamento com Instituicao
    public function instituicao()
    {
        return $this->belongsTo(Institution::class, 'id_institution');
    }

    // Relacionamento com Curso
    public function curso()
    {
        return $this->belongsTo(Course::class, 'id_course');
    }
}
