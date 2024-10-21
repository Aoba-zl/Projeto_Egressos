<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Institution extends Model
{
    use HasFactory;
                /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'id_address',
    ];
        // Relacionamento com Perfil_Egresso
    public function endereco()
    {
        return $this->belongsTo(Address::class, 'id_address');
    }

    public static function checkAndSaveInstitution(Request $request){
        $request->validate([
            "name" => "required|string"
            ,"address.cep" => "required|string|min:8|max:8"
            ,"address.num_porta" => "required|numeric"
        ]);

        $address = Address::saveAddress($request);

        $repeated = Institution::select("*")->where('name',$request->name)->where('id_address',$address->id)->first();

        if($repeated == null){
            $storedInstitution = Institution::create([
                "name" => $request->name 
                ,"id_address" => $address->id
            ]);

            return $storedInstitution;
        }

        return $repeated;
    }

    public static function checkAndSave($name){
        $address = 1;

        $repeated = Institution::select("*")
                        ->where('name',$name)->first();

        if($repeated == null){
            $storedInstitution = Institution::create([
                "name" => $name 
                ,"id_address" => $address
            ]);

            return $storedInstitution;
        }

        return $repeated;
    }
    public static function searchByName(Request $request)
    {
        // Captura o parâmetro 'name' da requisição
        $name = $request->input('name');

        // Faz a consulta ao banco de dados com ou sem o filtro por nome
        $courses = Institution::select('name')
            ->when($name, function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%');
            })
            ->groupBy('name')
            ->paginate(10); // Paginação com 10 resultados por página

        // Retorna a resposta em formato JSON
        return response()->json($courses);
    }
}
