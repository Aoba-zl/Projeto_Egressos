<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
                /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'site',
        'id_address'
    ];
        // Relacionamento com Perfil_Egresso
        public function endereco()
        {
            return $this->belongsTo(Address::class, 'id_address');
        }
}
