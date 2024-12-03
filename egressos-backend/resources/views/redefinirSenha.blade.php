<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Egressos da FATEC Zona Leste">
    <title>Egressos - Redefinir Senha</title>

    <!-- RESET -->
    <link rel="stylesheet" href="./css/reset.css">

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/general_devices.css">
    <link rel="stylesheet" href="./css/login/devices.css">
    <link rel="stylesheet" href="./css/login/login_style.css">

    <!-- FAVICON -->
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
</head>
<body>
    <header id="header">

    </header>
    <main>
        <div class="row">
            <div class="col-sm-12 col-md-6" id="imgLogin">

            </div>
            <div class="col-sm-12 col-md-6 p-4">
                <h2 class="text-center">Redefinição de Senha</h2>
                <form class="form-signin mt-5">
                    <div class="form-group">
                        <label for="txtEmail">Email:</label>
                        <input type="email" class="form-control" id="txtEmail" placeholder="Digite seu E-mail">
                    </div>

                    <div class="mt-5 text-center">
                        <button type="button" id="btnResetPasswd" class="btn btn-primary">
                            Enviar email para redefinir a senha
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <footer id="footer">

    </footer>

    <script src="./js/globals.js"></script>
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="module" src="./js/redefinirSenha_script.js"></script>
</body>
</html>