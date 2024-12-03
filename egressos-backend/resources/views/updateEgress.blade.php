<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Egressos da FATEC Zona Leste">
    <title>Egressos - Encontre seus colegas</title>

    <!-- RESET -->
    <link rel="stylesheet" href="./css/reset.css">

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/general_devices.css">
    <link rel="stylesheet" href="./css/cadastro/cadastro_style.css">
    <link rel="stylesheet" href="./css/cadastro/devices.css">
    <link rel="stylesheet" href="./css/updateEgress/updateEgress_style.css">

    <!-- MATERIAL ICONS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!-- FAVICON -->
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
</head>
<body>
    <header id="header"></header>
    <div id="cad-modal" class="modal modal-lg" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer" id="modal-footer">
                    <button type="button" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <main>
        <div class="row p-4">
            <div class="col-sm-12 col-lg-3 data-section">
                <div id="divLoadProfilePhoto" class="mb-4">
                    <div class="profile-pic">
                        <label class="-label" for="inputImagemPerfil">
                          <span class="glyphicon glyphicon-camera"></span>
                          <span>Mudar Imagem</span>
                        </label>
                        <input type="file" id="inputImagemPerfil"/>
                        <img src="./img/profile_picture.png" id="exbImagemPerfil" width="200" />
                      </div>
                </div>
                <div id="divFormDadosBasicos">
                    <form action="">
                        <div class="form-group mb-3">
                            <label for="txtName">Nome:</label>
                            <input type="text" class="form-control" id="txtName" placeholder="Digite seu nome">
                        </div>
                        <div class="form-group mb-3">
                            <label for="txtCPF">CPF:</label>
                            <input type="text" class="form-control" id="txtCPF" placeholder="Digite seu CPF">
                        </div>
                        <div class="form-group mb-3">
                            <label for="txtFone">Telefone:</label>
                            <input type="text" class="form-control" id="txtFone" placeholder="Digite seu número de telefone">


                            <div id="divCbFone" class="">
                                <input type="checkbox" name="cbFonePublico" id="cbFonePublico" class="">
                                <label for="cbFonePublico">Usar como contato público</label>
                            </div>
                        </div>
                        <div class="form-group mb-3 ">
                            <label for="txtDtNasc">Data Nascimento:</label>
                            <input type="date" class="form-control" id="txtDtNasc" placeholder="Digite sua Data de Nascimento">
                        </div>
                    </form>
                </div>
            </div>
            <div id="aluno-dados" class="col-sm-12 col-lg-5 mb-5 data-section">
                <h2>Contatos</h2>
                <div id="user-contacts" class="info-area">

                </div>   
                <div class="col-12 text-center">
                    <button type="button" class="btn btn-outline-primary btn-lg" id="btnAddContato">
                        Adicionar contato
                    </button>
                </div>   
                <div class="col-12 mt-5 margin-top">
                    <h2>Escreva seu Feedback!</h2>
                    <textarea id="txtFeedback">

                    </textarea>
                </div>
            </div>
            <div class="col-sm-12 col-lg-4 data-section">
                <div id="divExpAcademica" class="mb-5">
                    <h2>Experiências Acadêmicas</h2>
                    <div id="user-academic-exp" class="info-area">

                    </div>   
                    <div class="col-12 text-center">
                        <button type="button" class="btn btn-outline-primary btn-lg" id="btnAddAcadExp">
                            Adicionar Experiência Acadêmica
                        </button>
                    </div>  
                </div>

                <div id="divExpProfissional"></div>
                    <h2>Experiências Profissionais</h2>
                    <div id="user-profission-exp" class="info-area">

                    </div>   
                    <div class="col-12 text-center">
                        <button type="button" class="btn btn-outline-primary btn-lg" id="btnAddProfissionalExp">
                            Adicionar Experiência Profissional
                        </button>
                    </div>  
                </div>
            </div>
            <div class="text-end" >
                <button type="button" class="btn btn-success btn-lg mb-5" id="btnContinuarCadastro">
                    Enviar para Análise
                </button>
            </div>
        </div>     
    </main>
    <footer id="footer"></footer>

    <script src="./js/globals.js"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>   

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script src="./js/updateEgress.js"></script>
    <script src="./js/modals/modalContato.js"></script>
    <script src="./js/modals/modalExpAcademica.js"></script>
    <script src="./js/modals/modalProfExp.js"></script>
</body>
</html>