<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreAssessmentRequest;
use App\Models\Assessment;
use App\Models\User;

class AssessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        var_dump("Implemente-me"); // TODO: Implementar Controle AssessmentController
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAssessmentRequest $request)
    {
        $user = User::getUserByToken($request->user_token);
        if(User::isAdmin($user)){
            $assessment=$request->assessment;
            $status = $request->status;

            if ($status == config('constants.STATUS_REPROVED') && $assessment['comment'] == '') {
                return response()->json(['message' => 'Comentário deve ser obrigatório para reprovação'], 400);
            }       

            if(Assessment::saveAssessment($assessment,$status)){
                return response()->json([
                    'message' => 'Avaliação feita com sucesso!',
                ]);
            }else{
                return response()->json([
                    'message' => 'Você não é um moderador',
                ],401);
            }
        }else{
            return response()->json([
                'message' => 'Você não é um moderador',
            ],403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id,$user_token)
    {
        $user = User::getUserByToken($user_token);
        if(User::isSameUser($id,$user)){
            $assessment = Assessment::select('*')
                            ->where('id_egress',$id)
                            ->orderBy('created_at','DESC')
                            ->first();
            return response()->json($assessment);
        }else{
            return response()->json(["message" => "Unauthorized"],403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
