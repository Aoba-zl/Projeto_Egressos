<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feedbacks = Feedback::select('id','id_profile','comment')->paginate(50);
        return response()->json( $feedbacks );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "id_profile" => "required|integer"
            ,"comment" => "required|string"
        ]);
        
        $storedFeedback = Feedback::checkAndSaveFeedback($request);

        return response()->json($storedFeedback);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $feedback = Feedback::select('id','id_profile','comment')->where("id",$id);
        return response()->json( $feedback );
       
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //

        $feedback = Feedback::find($request->id);
        if ($feedback) {
            $validatedData = $request->validate([
                'comment' => 'sometimes|string|max:255',
            ]);

            $feedback->update($validatedData);

            return response()->json("Feedback atualizado com sucesso!",$feedback);
        }

        return response()->json(['message' => 'Feedback não encontrado'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

    }
}
