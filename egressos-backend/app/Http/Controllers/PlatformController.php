<?php

namespace App\Http\Controllers;

use App\Models\Platform;
use Illuminate\Http\Request;

class PlatformController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $platforms = Platform::select('id','name')->get();
        return response()->json($platforms);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:platforms'
        ]);

        $stored = Platform::create([
            'name' => $request->name
        ]);

        return response()->json($stored);
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
            'id' => 'required|integer|exists:platforms,id',
            'name' => 'required|string'
        ]);

        $platformToUpdate = Platform::find($request->id);
        $platformToUpdate->name = $request->name;
        $platformToUpdate->save();

        return response()->json($platformToUpdate);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:platforms,id'
        ]);

        $platformToDelete = Platform::find($request->id);
        $platformToDelete->delete();

        return response()->json(['message' => 'Platform deleted','platform' => $platformToDelete]);
    }
}
