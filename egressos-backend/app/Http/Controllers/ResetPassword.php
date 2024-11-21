<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailController;
use App\Models\Token_reset_password;
use Exception;
use Illuminate\Support\Str;

class ResetPassword extends Controller
{
    public function request_reset(Request $request)
    {
        // recebe endereço de email
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email']
        ]);
        $email = $request->email;

        // criar e armazenar um token
        $key_token = Str::random(10);

        try
        {
            Token_reset_password::upsert(
                ['email' => $email,
                'token' => $key_token],
                ['email'],
                ['token']
            );
        }
        catch (Exception $e)
        {
            return response()->json([
                'message' => 'Erro ao tentar enviar o email! Token',
                'erro' => $e
            ]);
        }

        // enviar o email para o endereço
        try
        {
            Mail::to($email)->send(new EmailController($key_token, 'reset_mail'));
        } catch ( Exception $e )
        {
            return response()->json(
                ['message' => 'Erro ao tentar enviar o email']
            );
        }

        // retorna se houve sucesso ou não
        return response()->json(
            ['message' => 'Email enviado com sucesso!']
        );
    }

    public function validate_token(Request $request)
    {
        // TODO: Validação do token
        // recebe token, email

        // validar token

        // retornar o usuário ou falha

    }


    public function delete_token(Request $request)
    {
        // receber o token
        $request->validate([
            'email' => ['required', 'email', 'exists:token_reset_passwords,email']
        ]);

        $email = $request->email;

        // deletar o token
        Token_reset_password::where('email', $email)->delete();

        return response()->json(['message' => 'token deletado com sucesso']);
    }


}
