<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

	<title>Consulta Quantidade</title>

	<!-- CDN do bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> <!-- se tirar essa linha a pagina pega a tela inteira porém outras coisas param de funcionar  -->
    <link rel="stylesheet" href="../../css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
    <?php

    $idProduto = $_GET['idProduto'];


    ?>

    <?php
			include "../verifica.php";
			include_once "../fachada.php";
			include_once "navegacao.php" 

        ?>

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
                    <div class="user">
                        <div class="cad_user">
                            <div class="info_user">
                                <?php
                                    echo "<form action=\"../organiza_carrinho.php?acao=adicionar&id=$idProduto\" method=\"POST\">"
                                ?>
                                <div class="row bxUser">
                                    <label>Informe a quantidade do produto</label>
                                    <input type="number" name="qtdProduto" id="qtdProduto" placeholder="Quantidade de produto">
                                </div>
                                <div class="row" style="text-align: right">
                                    <button class="btn btn-success" type="submit">Adicionar ao carrinho</button>
                                </div>
                            </div>
                        </div>
                    </div>

				</div>
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