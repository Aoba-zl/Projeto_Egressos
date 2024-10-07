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
        $limit = $request->input('limit', 4);  // Quantidade de itens por página, por padrão 4
        $page = $request->input('page', 1);    // Página atual, por padrão 1
    
        // Chama o método no model para buscar todos os dados
        $results = Egress::getEgressWithCompanyAndFeedback();
    
        // Converte o resultado para array usando json_encode/json_decode
        $resultsArray = json_decode(json_encode($results), true);
    
        // Aplica a lógica de paginação manualmente
        $offset = ($page - 1) * $limit;
        $paginatedData = array_slice($resultsArray, $offset, $limit);
    
        // Cria a resposta paginada manualmente
        $total = count($resultsArray);
        $response = [
            'current_page' => $page,
            'data' => $paginatedData,
            'first_page_url' => url('/api/egresses?page=1'),
            'from' => $offset + 1,
            'last_page' => ceil($total / $limit),
            'last_page_url' => url('/api/egresses?page=' . ceil($total / $limit)),
            'links' => [
                [
                    'url' => $page > 1 ? url('/api/egresses?page=' . ($page - 1)) : null,
                    'label' => '&laquo; Previous',
                    'active' => false,
                ],
                [
                    'url' => url('/api/egresses?page=' . $page),
                    'label' => (string) $page,
                    'active' => true,
                ],
                [
                    'url' => $page < ceil($total / $limit) ? url('/api/egresses?page=' . ($page + 1)) : null,
                    'label' => 'Next &raquo;',
                    'active' => false,
                ],
            ],
            'next_page_url' => $page < ceil($total / $limit) ? url('/api/egresses?page=' . ($page + 1)) : null,
            'path' => url('/api/egresses'),
            'per_page' => $limit,
            'prev_page_url' => $page > 1 ? url('/api/egresses?page=' . ($page - 1)) : null,
            'to' => $offset + count($paginatedData),
            'total' => $total,
        ];
    
        // Retorna a resposta paginada em formato JSON
        return response()->json($response);
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
