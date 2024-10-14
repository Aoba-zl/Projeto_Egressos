<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Course extends Model
{
    use HasFactory;
            /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type_formation',
    ];

    public static function checkAndSaveCourse(Request $request){
        $request->validate([
            "name" => "required|string"
            ,"type_formation" => "required|string"
        ]);

        $repeated = Course::select('*')
            ->where('name',$request->name)
            ->where('type_formation',$request->type_formation)
            ->first();

        if($repeated == null){
            $storedCourse = Course::create([
                'name' => $request->name 
                ,'type_formation' => $request->type_formation
            ]);

            return $storedCourse;
        }

        return $repeated;
    }

    public static function checkAndSave($name,$type_formation){
        $repeated = Course::select('*')
        ->where('name',$name)
        ->where('type_formation',$type_formation)
        ->first();

        if($repeated == null){
            $storedCourse = Course::create([
                'name' => $name 
                ,'type_formation' => $type_formation
            ]);

            return $storedCourse;
        }

        return $repeated;
    }
    public static function searchByName(Request $request)
    {
        // Captura o parâmetro 'name' da requisição
        $name = $request->input('name');

        // Faz a consulta ao banco de dados com ou sem o filtro por nome
        $courses = Course::select('id', 'name', 'type_formation')
            ->when($name, function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%');
            })
            ->paginate(10); // Paginação com 10 resultados por página

        // Retorna a resposta em formato JSON
        return response()->json($courses);
    }
}
