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
    <link rel="stylesheet" href="./css/buscaAlunos/busca_style.css">
    <link rel="stylesheet" href="./css/buscaAlunos/devices.css">

    <!-- FAVICON -->
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
</head>
<body>
    <header id="header"></header>
    <main>
        <div class="p-4">
            <h2>Busca de Alunos</h2>
        </div>
        <div>
            <form id="buscaDeAlunos" class="mb-5" action="">
                <div class="form-group">
                    
                    <input type="text" id="txtSearchAluno" class="form-control" placeholder="Digite o nome de um aluno para encontrá-lo">

                    <button type="button" id="btnBuscaAlunos" class="btn btn-light">🔍</button>                    
                </div>
            </form>
            <div id="divCardsAluno">
                <div id="egress-list"></div>
                

            </div>
            <div id="divPaginacao">
                <span id="leftIcon" class="material-symbols-outlined">
                    chevron_left
                </span>
                <div class="text-center" id="pagination"></div>
                <span id="rightIcon" class="material-symbols-outlined">
                    chevron_right
                </span>
            </div>
        </div>        
    </main>
    <footer id="footer"></footer>

    <script src="./js/globals.js"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="module" src="./js/buscaAlunos_script .js"></script>
</body>
</html>