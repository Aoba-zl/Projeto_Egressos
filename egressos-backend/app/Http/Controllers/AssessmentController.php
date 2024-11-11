<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreAssessmentRequest;
use App\Models\Assessment;
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
    public function store( StoreAssessmentRequest $request)
    {
        $assessment=$request->assessment;
        $status = $request->status;

        if ($status == config('constants.STATUS_REPROVED') && $assessment['comment'] == '') {
            return response()->json(['message' => 'Comentário deve ser obrigatório para reprovação'], 400);
        }       

        Assessment::saveAssessment($assessment,$status);
        return response()->json([
            'message' => 'Avaliação feita com sucesso!',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $assessment = Assessment::select('*')
                        ->where('id_egress',$id)
                        ->orderBy('created_at','DESC')
                        ->first();
        return response()->json($assessment);
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
