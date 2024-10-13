<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
            /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array
     */
    protected $fillable = [
        'id_profile',
        'comment',
    ];

        // Relacionamento com Perfil_Egresso
        public function perfilEgresso()
        {
            return $this->belongsTo(Egress::class, 'id_profile');
        }
        
}
