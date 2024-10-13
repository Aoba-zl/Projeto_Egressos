<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::select('id','name','type_formation')->paginate(10);
        return response()->json($courses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        
        $request->validate([
            "name" => "required|string"
            ,"type_formation" => "required|string"
        ]);
        
        $storedCourse = Course::checkAndSaveCourse($request);

        return response()->json($storedCourse);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            "id"=>"required|integer|exists:courses,id"
            ,"name" => "required|string"
            ,"type_formation" => "required|string"
        ]);

        $courseToUpdate = Course::find($request->id);
        $courseToUpdate->name = $request->name;
        $courseToUpdate->type_formation = $request->type_formation;
        $courseToUpdate->save();

        return response()->json($courseToUpdate);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            "id"=>"required|integer|exists:courses,id"
        ]);

        $courseToDelete = Course::find($request->id);
        $courseToDelete->delete();

        return response()->json(['message' => 'Course deleted','platform' => $courseToDelete]);
    }
}
