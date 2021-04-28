<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>

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
      <a class="navbar-brand" href="index.html">Submarino</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
          <li class="nav-item">
            <a class="nav-link" href="login.html">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cadastro_conta.html">Contas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cadastro_prod.php">Cadastrar Produtos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cadastro_fornec.html">Cadastrar Fornecedores</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="manut_estoque.html">Consulta e manutenção</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

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
      <div class="row align-items-center">
        <div class="col-lg-6 order-lg-1">
          <div class="p-5">
            <h2 class="display-4">Faça o cadastro do produto abaixo:</h2>
          </div>
          <form action="../insere_produto.php" method="POST" role="form">
            <div class="form-group">
              <label style="margin-left:47px">Código do produto</label>
              <input style="margin-left:47px" type="number" class="form-control" id="cod_produto" name="cod_produto">
            </div>
            <div class="form-group">
              <label style="margin-left:47px">Nome do produto</label>
              <input style="margin-left:47px" type="text" class="form-control" id="nome_produto" name="nome_produto">
            </div>
            <div class="form-group">
              <label style="margin-left:47px">Descrição do produto</label>
              <input style="margin-left:47px" type="text" class="form-control" id="desc_produto" name="desc_produto">
            </div>
            <div class="form-group">
              <label style="margin-left:47px" for="Fornecedor">Selecione um fornecedor:</label>
                                    <select  name="Fornecedor" id="Fornecedor">
                                        <?php
                                            
                                            include_once "../fachada.php";

                                            $dao = $factory->getFornecedorDao();
                                            $fornecedores = $dao->buscaTodos();

                                            if ($fornecedores)
                                            {
                                                foreach ($fornecedores as $fornecedor)
                                                {
                                                    echo "<option value=\"" . $fornecedor->getId() . "\">" . $fornecedor->getNome() . "</option>";
                                                }
                                            }
                                        ?>
                                    </select>
            </div>
            <div class="form-group">
              <button style="margin-left:47px" type="submit" class="btn btn-primary">Cadastrar</button>
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