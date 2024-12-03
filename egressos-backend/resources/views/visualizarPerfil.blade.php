<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Egressos</title>

    <!-- RESET -->
    <link rel="stylesheet" href="./css/reset.css">

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Material Icons -->
    <link
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=block"
      rel="stylesheet" />

    <!-- CSS -->
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/general_devices.css">
    <link rel="stylesheet" href="./css/visualizacao/visualizacao_style.css">
    <link rel="stylesheet" href="./css/visualizacao/devices.css">
</head>
<body>
    <div id="motivo-rejeicao-modal" class="modal modal-lg" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">
                        Seu Perfil foi Rejeitado
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body">
                    <form>
                        <label for="txtDescricao">Motivo da rejeição do perfil: </label>
                        <textarea class="form-control mb-3" id="txtDescricao">

                        </textarea>
                    </form>
                </div>
                <div class="modal-footer" id="modal-footer">
                    <button type="button" id="btnEditarPerfil" class="btn btn-warning" onclick="window.location.href = './updateegress'">Editar perfil agora</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    <header id="header">

    </header>
    <main>
        <div class="row">
            <div class="col-sm-12 col-lg-3">
                <div id="divImgPerfil">
                    <!-- imagem do egresso -->
                    <img src="./img/profile_picture.png" alt="Foto do Perfil" srcset="">
                </div>
                <div id="divContatos">

                </div>
            </div>
            <div id="aluno-dados" class="col-sm-12 col-lg-5">
                <div>
                    <span id="aluno-nome-completo">.....</span>
                </div>
                <div>
                    <span id="aluno-idade"></span>
                </div>

                <span class="aux-label">Cursou:</span>
                <div id="aluno-curso">
                    <span id="aluno-curso-nome"></span>
                    <span id="aluno-curso-conclusao"></span>
                </div>

                <span class="aux-label">Trabalha atualmente em:</span>
                <div>
                    <span id="aluno-trabalho-atual"></span>
                </div>

                <span class="aux-label">Feedback</span>
                <div>
                    <textarea name="txtFeedback" id="txtFeedback">
                    </textarea>
                </div>
            </div>
            <div class="col-sm-12 col-lg-4">
                <span class="aux-label">Outras Experiencias Acadêmicas</span>
                <div id="exps-academicas">

                </div>

                <span class="aux-label">Outras Experiencias Profissionais</span>
                <div id="exps-profissionais">

                </div>

                <div id="edit-profile" >
                     <button class="btn btn-warning d-none" id="editProfile">Editar Dados</button>
                </div>
            </div>
        </div>
    </main>
    <footer id="footer">

    </footer>
    <script src="./js/globals.js"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script type="module" src="./js/visualizacao_script.js"></script>

</body>
</html>