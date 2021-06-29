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
           
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 order-lg-1">
          <div class="p-5">
            <h2 class="display-4">Produtos</h2>
          </div>
                <form action="./produtos.php" method="POST">
                <div class="form-group">
                  <label for="txtBusca">Buscar:</label>
                  <input type="text" class="form-control form-control-user" id="txtBusca" name="txtBusca">
            </div>
            <div class="form-group">
                  <select class="form-control form-control-user" id="tipoSel" name="tipoSel">
                    <option value="id">Id</option>
                    <option value="nome">Nome</option>
                  </select>
            </div>
            <div class="text-center form-group" style="margin-left: -60px;">
                  <button style="margin-left:47px" type="submit" class="btn btn-primary">Buscar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="row">
          <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col">Nome</th>
                                <th scope="col">Código</th>
                                <th scope="col">Descrição</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                                            
                            include_once "../fachada.php";

                            $dao = $factory->getProdutoDao();
                            $produtos = null;

                            if (isset($_POST["txtBusca"]) && isset($_POST["tipoSel"]) && !empty(@$_POST["txtBusca"]) && !empty(@$_POST["tipoSel"]))
                            {
                                $busca = @$_POST["txtBusca"];
                                $tipoBusca = @$_POST["tipoSel"];
                            }
                            else
                            {
                                $produtos = $dao->buscaTodos();
                            }
                            
                            if (!empty($busca) && $tipoBusca == "id")
                            {
                                $produto = $dao->buscaPorId($busca);
                                if ($produto)
                                {
                                    $produtoId = $produto->getId();
                                    
                                    echo "<tr>";
                                    echo "<td><a href=./consulta_quantidade.php?idProduto=$produtoId><span>Adicionar</span></a></td>";
                                    echo "<td>" . $produto->getNome() . "</td>";
                                    echo "<td>" . $produto->getCodProduto() . "</td>";
                                    echo "<td>" . $produto->getDescricao() . "</td>";
                                    echo "</tr>";
                                }
                            }
                            else if (!empty($busca) && $tipoBusca == "nome")
                            {
                                $produtos = $dao->buscaPorNome($busca);
                            }

                            if ($produtos)
                            {
                                foreach ($produtos as $produto)
                                {

                                    $produtoId = $produto->getId();

                                    echo "<tr>";
                                    echo "<td><a href=./consulta_quantidade.php?idProduto=$produtoId><span>Adicionar</span></a></td>";
                                    echo "<td>" . $produto->getNome() . "</td>";
                                    echo "<td>" . $produto->getCodProduto() . "</td>";
                                    echo "<td>" . $produto->getDescricao() . "</td>";
                                    echo "</tr>";
                                }
                            }
                        ?>
           </tbody>
          </table>
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
  <script src="./js/script.js"></script>

</body>
</html>