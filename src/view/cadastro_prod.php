<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Cadastro Produto</title>

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
            <h2 class="display-4">Faça o cadastro do produto abaixo:</h2>
          </div>
          <form action="../insere_produto.php" method="POST" role="form" enctype="multipart/form-data"> 
            <div class="form-group">
              <input type="number" class="form-control form-control-user" id="cod_produto" name="cod_produto" placeholder="Código do Produto">
            </div>
            <div class="form-group">
              <input type="text" class="form-control form-control-user" id="nome_produto" name="nome_produto" placeholder="Nome do Produto">
            </div>
            <div class="form-group">
              <input type="text" class="form-control form-control-user" id="desc_produto" name="desc_produto" placeholder="Descrição do Produto">
            </div>
            <div class="form-group">
              <input type="file" class="form-control form-control-user" id="img_produto" name="img_produto" placeholder="Insira a imagem do Produto">
              <label style="font-style: italic">
                É recomendado enviar uma imagem de dimensões 1920x1080+
              </label>
            </div>
            <div class="form-group">
              <label for="Fornecedor">Selecione um fornecedor:</label>
                                    <select class="form-control form-control-user" name="Fornecedor" id="Fornecedor">
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
            <hr>
            <div class="text-center form-group" style="margin-left: -60px;">
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
