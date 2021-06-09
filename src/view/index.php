<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Home</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/one-page-wonder.min.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">Submarino</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <li class="nav-item">
              <a class="nav-link" href="login.html">Login</a>
            </li>
            <?php
              include_once "../verifica_adm.php";
              if($_SESSION["permissao"] == 2){

                echo"<li class=\"nav-item\">";
                  echo"<a class=\"nav-link\" href=\"cadastro_conta.html\">Contas</a>";
                echo"</li>";
                  echo"<li class=\"nav-item\">";
                  echo"<a class=\"nav-link\" href=\"cadastro_prod.php\">Cadastrar Produtos</a>";
                  echo"</li>";
                  echo"<li class=\"nav-item\">";
                  echo"<a class=\"nav-link\" href=\"cadastro_fornec.html\">Cadastrar Fornecedores</a>";
                  echo"</li>";
                  echo"<li class=\"nav-item\">";
                  echo"<a class=\"nav-link\" href=\"manut_estoque.html\">Consulta e manutenção</a>";
                  echo"</li>";
                  echo"<li class=\"nav-item dropdown no-arrow\">";
                  echo"<a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"userDropdown\" role=\"button\" data-toggle=\"dropdown\">";
                  echo"<span>Usuário Admin</span>";
                  echo"<img style=\"height: 30px;\" class=\"img-profile rounded-circle\"src=\"img/undraw_profile.svg\">";
                  echo"</a>";
                  echo"</li>";
              }
            ?>
            <form id="form_logout" action="../executa_logout.php" method="POST" role="form">
              <a href="javascript:$('#form_logout').submit();" class="btn btn-primary btn-user btn-block">Deslogar</a>
            </form> 
      </div>
    </div>
  </nav>

  <header class="masthead text-center text-white">
    <div class="masthead-content">
      <div class="container">
        <h1 class="masthead-heading mb-0">Submarino</h1>
        <h2 class="masthead-subheading mb-0">Todo dia ofertas arrasadoras, você não vai querer perder!</h2>
      </div>
    </div>
    <div class="bg-circle-1 bg-circle"></div>
    <div class="bg-circle-2 bg-circle"></div>
    <div class="bg-circle-3 bg-circle"></div>
    <div class="bg-circle-4 bg-circle"></div>
  </header>

  <section>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 order-lg-2">
          <div class="p-5">
            <img class="img-fluid rounded-circle" src="img/liquidificador.jpg" alt="">
          </div>
        </div>
        <div class="col-lg-6 order-lg-1">
          <div class="p-5">
            <h2 class="display-4">Liquidificador Mondial Turbo Power</h2>
            <p>Conheça o liquidificador da Mondial L-99 WB Turbo Power. Além de moderno e elegante na linda cor preta, ele conta com um novo sistema de encaixe pra deixar a montagem mais prática e fácil. Olha, o copo está super-resistente e transparente pra deixar os ingredientes mais visíveis. Sua capacidade total é de até 2,2 litros. </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <div class="p-5">
            <img class="img-fluid rounded-circle" src="img/cadeira.jpg" alt="">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="p-5">
            <h2 class="display-4">Cadeira Gamer MX5 Giratoria</h2>
            <p>A nova linha de Cadeira Gamer Mymax, são as mais iradas do mercado, a MX5 possui design ergonômico e revestimento em couro.
              Projetada para proporcionar conforto mesmo após horas jogando. </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 order-lg-2">
          <div class="p-5">
            <img class="img-fluid rounded-circle" src="img/batedeira.jpg" alt="">
          </div>
        </div>
        <div class="col-lg-6 order-lg-1">
          <div class="p-5">
            <h2 class="display-4">Batedeira Prática 350W, 127V, Preta, Mondial - B-12-NP</h2>
            <p>350W de potência: Muito mais potência para melhor resultado de suas receitas do dia a dia. Tigela grande de 3, 6 l: Prepara receitas com grande quantidade de ingredientes.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="py-5 bg-black">
    <div class="container">
      <p class="m-0 text-center text-white small">Copyright &copy; Your Website 2020</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>