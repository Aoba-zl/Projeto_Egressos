<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Egressos da FATEC Zona Leste">
    <title>Egressos - Cadastre-se</title>
    
    <!-- RESET -->
    <link rel="stylesheet" href="./css/reset.css">

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/general_devices.css">
    <link rel="stylesheet" href="./css/cadastro/cadastro_style.css">
    <link rel="stylesheet" href="./css/cadastro/devices.css">

</head>
<body>
    <header id="header"></header>
    <main>
        <div class="row">
            <div class="col-sm-12 col-md-6" id="imgFatecCadastro">

            </div>
            <div class="col-sm-12 col-md-6 p-4">
                <h2 class="text-center">Cadastro</h2>
                <p class="p-3">
                    Antes de prosseguir informe um email e senha. Atravéz deles poderá companhar seu 
                    perfil e solicitações
                </p>
                <form class="form-signin">
                        <div class="form-group">
                            <label for="txtNome">Nome completo:</label>
                            <input type="text" class="form-control" id="txtNome" placeholder="Digite seu nome completo">
                        </div>
                        <div class="form-group">
                            <label for="txtEmail">Email:</label>
                            <input type="email" class="form-control" id="txtEmail" placeholder="Digite seu email">
                        </div>
                        <div class="form-group">
                            <label for="txtSenha">Senha:</label>
                            <input type="password" class="form-control mb-4" id="txtSenha" placeholder="Digite sua senha">
                        </div>
                        <div class="form-group">
                            <label for="txtConfirmacaoSenha">Confirme sua Senha:</label>
                            <input type="password" class="form-control mb-4" id="txtConfirmacaoSenha" placeholder="Digite sua senha novamente">
                        </div>
                        <div class="text-center">
                            <input type="checkbox" id="cbAgreement">
                            <label for="cbAgreement">
                                Li e concordo com os 
                                    <a href="./resources/termos_de_uso.pdf" target="_blank">Termos de Uso</a>
                            </label>                            
                        </div>
                        <div class="mt-3 text-center">
                            <button type="button" class="btn btn-primary" id="btnContinueCad">Continuar</button>
                        </div>
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
    <script type="module" src="./js/cadastro_script.js"></script>
</body>
</html>