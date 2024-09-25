<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;

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
    public function login(Request $request)
    {
        // Validar os dados de entrada
        $validatedData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);

        // Verificar se o usuário existe com o email fornecido
        $user = User::where('email', $validatedData['email'])->first();

        // Verificar se a senha está correta
        if (!$user || !Hash::check($validatedData['password'], $user->password)) {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }

        // Gerar o token usando o Sanctum
        $token = $user->createToken('auth_token')->plainTextToken;

        // Retornar o token e o usuário autenticado
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ], 200);
    }
    // Criar um novo usuário
    public function store(StoreUserRequest $request)
    {

        $typeAccount = $request->input('type_account');
        $typeAccountLabel = '';

        switch ($typeAccount) {
            case '0':
                $typeAccountLabel = 'Egresso'; // 0 -> Egresso
                break;
            case '1':
                $typeAccountLabel = 'Admin'; // 1 -> Admin
                break;
            case '2':
                $typeAccountLabel = 'Moderador'; // 2 -> Moderador
                break;
        }

        // Criação do usuário
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'type_account' => $typeAccount,
        ]);

        // Resposta JSON
        return response()->json([
            'user' => $user,
            'type_account_label' => $typeAccountLabel,
        ], 201);
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
