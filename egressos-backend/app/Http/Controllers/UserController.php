<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Exibir a lista de usuários
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    // Exibir um usuário específico
    public function show($id)
    {
        $user = User::find($id);
        if ($user) {
            return response()->json($user);
        }
        return response()->json(['message' => 'User not found'], 404);
    }

    // Criar um novo usuário
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'type_account' => 'required'
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'type_account' => $validatedData['type_account']
        ]);

        return response()->json($user, 201);
    }

    // Atualizar um usuário existente
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if ($user) {
            $validatedData = $request->validate([
                'name' => 'sometimes|string|max:255',
                'email' => 'sometimes|string|email|max:255|unique:users,email,' . $user->id,
                'password' => 'sometimes|string|min:8',
            ]);

            if (isset($validatedData['password'])) {
                $validatedData['password'] = bcrypt($validatedData['password']);
            }

            $user->update($validatedData);
            return response()->json($user);
        }

        return response()->json(['message' => 'User not found'], 404);
    }

    // Deletar um usuário
    public function destroy($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return response()->json(['message' => 'User deleted successfully']);
        }

        return response()->json(['message' => 'User not found'], 404);
    }
}
