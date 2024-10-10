<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAcademicFormationRequest;
use App\Models\AcademicFormation;
use Illuminate\Http\Request;
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
    public function store(StoreAcademicFormationRequest $request)
    {
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
        $formationToUpdate = AcademicFormation::find($id);
    
        $formationToUpdate->id_profile = $request->id_profile;
        $formationToUpdate->id_institution = $request->id_institution;
        $formationToUpdate->id_course = $request->id_course;
        $formationToUpdate->begin_year = $request->begin_year;
        $formationToUpdate->end_year = $request->end_year;
        $formationToUpdate->period = $request->period;

        $formationToUpdate->save();

        return response()->json($formationToUpdate);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
