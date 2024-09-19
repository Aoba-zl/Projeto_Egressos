<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
            /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array
     */
    protected $fillable = [
        'id_egress',
        'id_platform',
        'contact'
    ];
        // Relacionamento com Egress
        public function perfilEgresso()
        {
            return $this->belongsTo(Egress::class, 'id_egress');
        }
            // Relacionamento com Perfil_Egresso
    public function plataforma()
    {
        return $this->belongsTo(Platform::class, 'id_platform');
    }
}
