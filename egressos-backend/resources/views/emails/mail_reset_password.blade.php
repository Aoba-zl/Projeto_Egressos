<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinição de Senha</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            color: #333333;
        }
        p {
            color: #555555;
            line-height: 1.6;
        }
        .code {
            display: inline-block;
            font-size: 24px;
            font-weight: bold;
            background: #f8f9fa;
            padding: 10px 20px;
            margin: 20px 0;
            border: 1px dashed #cccccc;
            border-radius: 5px;
        }
        .footer {
            font-size: 12px;
            color: #999999;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Redefinição de Senha</h1>
    <p>Este e-mail é referente à solicitação de redefinição de senha para sua conta no <strong>fateczl.app.br</strong>.</p>
    <p>Utilize o código abaixo para redefinir sua senha:</p>
    <div class="code">{{ $mail_token }}</div>
    <p>Se você não solicitou a redefinição de senha, por favor, ignore este e-mail.</p>
    <div class="footer">
        &copy; 2024 site.com. Todos os direitos reservados.
    </div>
</div>
</body>
</html>
