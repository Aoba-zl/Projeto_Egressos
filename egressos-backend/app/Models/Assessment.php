<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;
        /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array
     */
    protected $fillable = [
        'email_moderator',
        'id_egress',
        'comment',
    ];
        // Relacionamento com Perfil_Egresso
        public function perfilEgresso()
        {
            return $this->belongsTo(Egress::class, 'id_egress');
        }
}
