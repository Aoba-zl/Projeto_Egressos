<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Egressos da FATEC Zona Leste">
    <title>Egressos - FATEC Zona Leste</title>

    <!-- RESET -->
    <link rel="stylesheet" href="./css/reset.css">

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/general_devices.css">
    <link rel="stylesheet" href="./css/home/home_style.css">
    <link rel="stylesheet" href="./css/home/devices.css">

</head>
<body>
  <header id="header">

  </header>
  <main>
      <section id="sec_apresentacao">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="row">
                <div class="col-sm-12 col-md-6 p-3 carrouselText">
                  <p class="text-justify">
                    Conheça as histórias de sucesso dos nossos egressos da Fatec Zona Leste e inspire-se para o futuro!
                  </p>
                </div>
                <div class="col-sm-12 col-md-6">
                  <picture class="d-block w-100">
                    <source media="(max-width:465px)" srcset="./img/fatec_1_240.webp">
                    <source media="(max-width:600px)" srcset="./img/fatec_1_480.webp">
                    <img src="./img/fatec_1.webp" alt="First slide">
                  </picture>
                </div>
              </div>
            </div>

            <div class="carousel-item">
              <div class="row">
                <div class="col-sm-12 col-md-6 p-3 carrouselText">
                  <p class="text-justify">
                    Veja onde nossos ex-alunos chegaram e descubra como a Fatec Zona Leste transforma carreiras!
                  </p>
                </div>
                <div class="col-sm-12 col-md-6">
                  <picture class="d-block w-100">
                    <source media="(max-width:465px)" srcset="./img/fatec_2_240.webp">
                    <source media="(max-width:600px)" srcset="./img/fatec_2_480.webp">
                    <img src="./img/fatec_2.webp" alt="Second slide">
                  </picture>
                </div>
              </div>
            </div>

            <div class="carousel-item">
              <div class="row">
                <div class="col-sm-12 col-md-6 p-3 carrouselText">
                  <p class="text-justify">
                    O caminho para o sucesso começa aqui! Explore as conquistas dos egressos da Fatec Zona Leste.
                  </p>
                </div>
                <div class="col-sm-12 col-md-6">
                  <picture class="d-block w-100">
                    <source media="(max-width:465px)" srcset="./img/fatec_3_240.webp">
                    <source media="(max-width:600px)" srcset="./img/fatec_3_480.webp">
                    <img src="./img/fatec_3.webp" alt="Third slide">
                  </picture>
                </div>
              </div>
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev" aria-label="Voltar slide">
            <span class="carousel-control-prev-icon bg-dark" aria-hidden="true"></span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next" aria-label="Avançar slide">
            <span class="carousel-control-next-icon bg-dark" aria-hidden="true"></span>
          </a>
        </div>
      </section>

      <section id="sec_numeros" class="d-none">
        <div class="row">
          <p class="col-sm-12 col-lg-6">+20.000 <br>Graduados</p>
          <p class="col-sm-12 col-lg-6">+10.000 <br>Trabalhando na Área</p>
        </div>
      </section>

      <section id="sec_depoimentos">
        <div class="row">
          <div class="col-12 text-center mb-4 mt-2">
            <h2>Depoimentos</h2>
          </div>
          <div id="divDepoimentos">

          </div>
          <div class="d-flex justify-content-center mb-3 mt-4">
            <a href="./buscaDeAlunos">
              <button type="button" class="btn btn-success">Veja mais egressos</button>
            </a>
          </div>
        </div>
      </section>

      <section id="sec_convite">
        <div class="row">
          <div class="col-12 text-center mb-4 mt-2">
            <h2>É um dos nossos Egressos?</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 col-md-6 p-3">
            <h3 class="text-center">
              Deixe que contemos sua história!
            </h3>
            <p class="text-center">
              Cadastre-se em nossa plataforma e
              divulgaremos seu sucesso profissional em
              nossas redes sociais, eventos e demais
              ocasiões para mostrarmos como ajudamos em
              sua jornada!
            </p>
            <p class="text-center">
              Porquê o <strong>seu</strong> sucesso é o <strong>nosso</strong> sucesso!
            </p>
            <div class="d-flex justify-content-center">
              <a href="./cadastro"><button id="btnCadastrar" class="btn btn-light mb-4">Cadastre-se</button></a>
            </div>
          </div>
          <div class="col-sm-12 col-md-6 d-flex justify-content-center">
            <img id="imgConvite" src="./img/john-schnobrich-2FPjlAyMQTA-unsplash.jpg" alt="Imagem Convite" srcset="">
          </div>
        </div>
      </section>

      <section id="sec_eventos">
        <div class="row">
          <div class="col-12 text-center mb-4 mt-2">
            <h2>Próximos Eventos</h2>
          </div>
          <div id="proximosEventos">

          </div>
        </div>
      </section>
  </main>

  <footer id="footer" class="">

  </footer>

  <script src="./js/globals.js"></script>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script type="module" src="./js/home_script.js"></script>
</body>
</html>