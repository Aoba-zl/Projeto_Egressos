<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Egress;
class Assessment extends Model
{
    use HasFactory;
        /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array
     */
    protected $fillable = [
        'id_moderator_admi',
        'id_egress',
        'comment',
    ];
        // Relacionamento com Perfil_Egresso
        public function perfilEgresso()
        {
            return $this->belongsTo(Egress::class, 'id_egress');
        }
        public static function saveAssessment($assessment,$status){
            $admin = User::find($assessment['id_moderator_admi']);
            if($admin->type_account){
                Assessment::create([
                    "id_moderator_admi" => $assessment['id_moderator_admi']
                    , "id_egress" => $assessment['id_egress']
                    , "comment" => $assessment['comment']
                ]);
                Egress::where('id', $assessment['id_egress'])
                ->update(['status' => $status]);
                return true;
            }
            return false;
        }
}
