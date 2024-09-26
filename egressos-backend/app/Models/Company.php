<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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

    public static function checkAndSaveCompany(Request $request){
        $request->validate([
            "name" => "required|string"
            ,"email" => "required|string|email|max:255"
            ,"phone" => "required|string"
            ,"address.cep" => "required|string|min:8|max:8"
            ,"address.num_porta" => "required|numeric"
        ]);

        $address = Address::saveAddress($request);

        $repeated = Company::select('*')
            ->where('name',$request->name)
            ->where('id_address',$address->id)
            ->orWhere('email',$request->email)
            ->first();
        
        if($repeated == null){
            $storedCompany = Company::create([
                "name" => $request->name 
                , "email" => $request->email 
                , "phone" => $request->phone 
                , "site" => $request->site 
                , "id_address" => $address->id
            ]);

            return $storedCompany;
        }

        return $repeated;
    }
}
