<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Token_reset_password;

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
        return response()->json(['message' => 'Usuário não encontrado'], 404);
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
            case config('constants.TYPE_ACCOUNT_USER'):
                $typeAccountLabel = 'Egresso'; // 0 -> Egresso
                break;
            case config('constants.TYPE_ACCOUNT_ADMIN'):
                $typeAccountLabel = 'Admin'; // 1 -> Admin
                break;
            case config('constants.TYPE_ACCOUNT_MOD'):
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
    public function update(UpdateUserRequest $request,$id)
    {
        $user = User::find($id);

        $userT = User::getUserByToken($request->user_token);

        if(!User::isSameUser($user->id,$userT)){
            return response()->json(["message"=>"Você não é o usuário que será editado"],403);
        }

        if ($user) {
            $user->update([
                'name'=>$request->name,

            ]);
            return response()->json($user);
        }

        return response()->json(['message' => 'Usuário não encontrado'], 404);
    }

    public function update_password(Request $request)
    {
        // return response()->json($request);
        $user = User::where('email', $request->email)->first();
        $token = Token_reset_password::where('email', $request->email)->where('token', $request->token)->first();

        if (!$token || !$token->is_valid)
            return response()->json(['error' => 'Código inválido! Valide o código recebido no e-mail, ou requisite outro!']);

        if ($user) {

            $user->update([
                'password' => bcrypt($request->input('password'))
            ]);
            return response()->json(['success' => "Senha redefinida"]);
        }

        return response()->json(['error' => 'Usuário não encontrado']);
    }

    // Deletar um usuário
    public function destroy($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return response()->json(['message' => 'Usuário deletado com sucesso!']);
        }

        return response()->json(['message' => 'Usuário não encontrado'], 404);
    }

    public function get_moderators()
    {
        $moderators = User::where('type_account', '1')->get();

        return response()->json($moderators);
    }

    public function search_users(Request $request)
    {
        // Pegar query de busca do request
        $searchQuery = $request->input('query', '');

        // Buscar usuários por nome ou email
        $users = User::where('name', 'LIKE', "%$searchQuery%")
                    ->orWhere('email', 'LIKE', "%$searchQuery%")
                    ->get();

        return response()->json($users);
    }

    public function toggle_moderator($id,$user_token)
    {
        $user = User::find($id);

        $admin = User::getUserByToken($user_token);

        if (!User::isMasterAdmin($admin)){
            return response()->json(['message' => 'Você não é um administrador do sistema'], 403);
        }

        if (!$user){
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        $msg = 'Usuário agora é um moderador';

        if ($user->type_account == '1'){
            $user->update(['type_account' => '0']);
            $msg = 'Usuário agora é um egresso';
        }
        else
            $user->update(['type_account' => '1']);

        return response()->json(['message' => $msg]);
    }


}
