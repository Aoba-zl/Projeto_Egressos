<?php

namespace App\Http\Controllers;
use App\Models\Egress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EgressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Define o limite e a página de forma opcional (padrão: 4 itens por página)
        $limit = $request->input('limit', 4);
    
        // Chama o método no model para buscar os dados paginados
        $results = Egress::getEgressWithCompanyAndFeedback($limit);
    
        // Retorna a resposta paginada em formato JSON
        return response()->json($results);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function searchByName(Request $request)
    {
        $name = $request->input('name');
        $egresses = Egress::getEgressByName($name);

        return response()->json($egresses);
    }
}
