<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailController;
use App\Models\Token_reset_password;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ResetPassword extends Controller
{
    public function request_reset(Request $request)
    {
        // recebe e valida endereço de email

        try {
            $this->validate_email($request);
        } catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 400);
        }

        $email = $request->email;

        // criar e armazenar um token
        $key_token = Str::random(10);

        try
        {
            Token_reset_password::upsert(
                ['email' => $email,
                'token' => $key_token,
                'is_valid' => false],
                ['email'],
                ['token', 'is_valid']
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

    private function validate_email(Request $request)
    {
        $rule = ['email' => ['required', 'email', 'exists:users,email']];
        $error_messages = [
            'required' => "Insira um e-mail!"
            , 'email' => "Insira um e-mail válido!"
            , 'exists' => "Insira um e-mail válido!"
        ];
        $validator = Validator::make($request->all(), $rule, $error_messages);

        if ($validator->fails())
            throw new Exception($validator->errors()->first());

        return true;
    }

    public function validate_token(Request $request)
    {
        // TODO: Validação do token
        $is_token_valid = Validator::make($request->all(), 
            [
                'email' => ['required', 'email', 'exists:token_reset_passwords,email']
                ,'token' => ['required', 'exists:token_reset_passwords,token']
            ]);

        if ($is_token_valid->fails())
            return response()->json(['error' => 'Código incorreto!']);

        $token = $request->token;
        $email = $request->email;

        $tokenRecord = Token_reset_password::where('email', $email)
        ->where('token', $token)
        ->first();

        if (!$tokenRecord) 
            return response()->json(['error' => 'Código incorreto!']);
        if ($tokenRecord->is_valid)
            return response()->json(['error' => 'Código expirado!']);

        $updated = $tokenRecord->update([
            'is_valid' => true
        ]);

        if (!$updated)
            return response()->json(['error' => 'Erro no servidor. Por favor, requisite outro código de validação!']);
        

        return response()->json(['success' => 'Código válido']);
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
