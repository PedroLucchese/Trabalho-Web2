<?php
    include "../fachada.php";

    $produtoId = $_GET['id'];
    $dao = $factory->getProdutoDao();
    try
    {
        $produto = $dao->buscaPorId($produtoId);
    }
    catch (Exception $e)
    {
    echo "<script>alert('Houve um problema ao buscar as informações deste usuário!\n Erro: $e')</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Produtos</title>

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
            <h2 class="display-4">Produto</h2>
          </div>
                <form action="./altera_produto.php?id=<?php echo $produtoId; ?>" method="POST" role="form">
                    <div class="user">
                        <div class="cad_user">
                            <div class="info_user">
                            <div class="form-group ClassHtml">
                                    <label for="">Nome:</label>
                                    <input type="text" name="nome" id="nome" value='<?php echo $produto->getNome() ?>'>
                                </div>
                                <div class="form-group ClassHtml">
                                    <label for="">Código:</label>
                                    <input type="number" name="codigo" id="codigo" value='<?php echo $produto->getCodProduto() ?>'>
                                </div>
                                <div class="ClassHtml">
                                    <label for="">Descrição:</label>
                                    <input type="text" name="descricao" id="descricao" value='<?php echo $produto->getDescricao() ?>'>
                                </div>
                                <div class="ClassHtmls" style="padding-top: 10px">
                                    <button style="background-color: red" type="button" onclick="document.location.href='./remove_produto.php?id=<?php echo $produtoId; ?>'">Excluir</button>
                                    <button type="submit">Alterar</button>
                                </div>
                                </div>
                            </div>
                          </div>
                      </div>
                  </form>
            </div>
      </div>
</div>
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