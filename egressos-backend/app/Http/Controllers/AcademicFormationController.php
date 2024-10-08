<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AcademicFormation;
class AcademicFormationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $acadFormations = AcademicFormation::paginate(50);
        return response()->json($acadFormations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'id_profile' => 'required|exists:platforms,id',
            'id_institution' => 'required|exists:egresses,id',
            'id_course' => 'required|exists:course,id',
            'begin_year' => 'required|integer',
            'end_year' => 'integer',
            'period' => 'required|string|max:255',
        ]);

        $acadFormation = AcademicFormation::create([
            'id_profile' => $request->id_profile,
            'id_institution' => $request->id_institution,
            'id_course' => $request->id_course,
            'begin_year' => $request->begin_year,
            'end_year' => $request->end_year,
            'period' => $request->period,
        ]);

        return response()->json($acadFormation);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $acadFormation = AcademicFormation::select('id','id_profile','id_institution','id_course',
        'begin_year','end_year','period')->where("id",$id);
        return response()->json($acadFormation );
       
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
