<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Cadastro</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/one-page-wonder.min.css" rel="stylesheet">

</head>

<body>

<!-- Nav -->
<?php include_once "navegacao.php" ?>

  <header class="masthead text-center text-white">
    <div class="masthead-content">
      <div class="container">
        <h1 class="masthead-heading mb-0">Submarino</h1>
      </div>
    </div>
    <div class="bg-circle-1 bg-circle"></div>
    <div class="bg-circle-2 bg-circle"></div>
    <div class="bg-circle-3 bg-circle"></div>
    <div class="bg-circle-4 bg-circle"></div>
  </header>

  <section>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 order-lg-1">
          <div class="p-5">
            <h2 class="display-4">Faça o cadastro abaixo:</h2>
          </div>
          <form action="../insere_usuario.php" method="POST" role="form">
            <div class="form-group">
              <input type="text" class="form-control form-control-user" id="cadastro_nome" name="cadastro_nome" placeholder="Nome">
            </div>
            <div class="form-group">
              <input type="email" class="form-control form-control-user" id="cadastro_email" name="cadastro_email" placeholder="E-mail">
            </div>
            <div class="form-group">
              <input type="password" class="form-control form-control-user" id="cadastro_senha" name="cadastro_senha" placeholder="Senha">
            </div>
            <div class="form-group">
              <input type="number" class="form-control form-control-user" id="cadastro_cpf" name="cadastro_cpf" placeholder="CPF">
            </div>
            <div class="form-group">
              <input type="text" class="form-control form-control-user" id="cadastro_telefone" name="cadastro_telefone" placeholder="Telefone">
            </div>
            <div class="form-group">
              <input type="text" class="form-control form-control-user" id="cadastro_cartao" name="cadastro_cartao" placeholder="Número do Cartao de Crédito">
            </div>
            <div class="form-group">
              <input type="text" class="form-control form-control-user" id="nome_titular" name="nome_titular" placeholder="Nome do Titular">
            </div>
            <div class="form-group">
              <input type="text" class="form-control form-control-user" id="cadastro_cvv" name="cadastro_cvv" placeholder="CVV">
            </div>
            <div class="form-group">
              <input type="text" class="form-control form-control-user" id="data_vencimento" name="data_vencimento" placeholder="Data de Vencimento">
            </div>
            <hr>
            <div class="text-center form-group" style="margin-left: -60px;">
              <button style="margin-left:47px" type="submit" class="btn btn-primary">Enviar</button>
              <button type="reset" class="btn btn-primary">Limpar</button>
            </div>
            <br>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="py-5 bg-black">
    <div class="container">
      <p class="m-0 text-center text-white small">Copyright &copy; Submarino 2021</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
