<?php

namespace App\Http\Controllers;
use App\Models\Feedback;

use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feedbacks = Feedback::select('id_profile','comment')->paginate(20);
        return response()->json( $feedbacks );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "id_profile" => "required|integer|exists:egresses,user_id"
            ,"comment" => "required|string"
        ]);
        
        $storedFeedback = Feedback::create(["id_profile"=>$request->id_profile,"comment"=>$request->comment]);

        return response()->json($storedFeedback);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $feedback = Feedback::select('id_profile','comment')->where("id_profile",$id);
        return response()->json( $feedback );
       
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {       
        $request->validate([
            'id_profile' => 'required',
            'comment' => 'sometimes|string|max:255'
        ]);

        $feedback = Feedback::select('*')->where('id_profile',$request->id_profile)->first();

       // $feedback->update($validatedData['comment']);

        //dd($feedback);
        $feedback->comment = $request->comment;
        $feedback->save();
        
        return response()->json(["message"=>"Feedback atualizado com sucesso!" ,"feedback"=>$feedback],200);

        //return response()->json(['message' => 'Feedback não encontrado'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

    }
}
