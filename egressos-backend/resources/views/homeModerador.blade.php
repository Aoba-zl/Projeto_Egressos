<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Egressos da FATEC Zona Leste">
    <title>Egressos - Moderação</title>

    <!-- RESET -->
    <link rel="stylesheet" href="./css/reset.css">

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/general_devices.css">
    <link rel="stylesheet" href="./css/homeModerador/devices.css">
    <link rel="stylesheet" href="./css/homeModerador/moderador_style.css">
</head>
<body>
    <header id="header">

    </header>
    <main>
        <div class="p-4">
            <h2>Moderação de Egressos</h2>
        </div>
        <div class="">
            <form id="buscaDeAlunos" class="mb-3" action="">
                <div class="form-group">
                    <select id="slcFiltroStatus" class="form-select">
                        <option value="0">Aguardando Análise</option>
                        <option value="1">Aprovado</option>
                        <option value="2">Reprovado</option>
                    </select>   

                    <input type="text" id="txtSearchAluno" class="form-control" placeholder="Digite o nome de um aluno para encontrá-lo">

                    <button type="button" id="btnBuscaAlunos" class="btn btn-light">🔍</button>                    
                </div>
            </form>
            <div id="card-list-container">
               
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
    <script type="module" src="./js/moderador_script.js"></script>
</body>
</html>