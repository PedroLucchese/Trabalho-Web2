<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

	<title>Carrinho de Compras</title>

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


	<?php require_once('../funcoes_carrinho.php'); ?>
	<?php //print_r( getCarrinho() ); ?>
	<?php
	// require_once('database/consultas.php');
	?>

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-6 order-lg-1">
				<div class="p-5">
					<a href="consulta_produtos.php" class="btn btn-warning" role="button">Produtos</a>
					<a href="carrinho.php" class="btn btn-danger" role="button">Meu Carrinho</a>
					<h1 class="display-1">Produtos do Carrinho</h1>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
      <div class="row justify-content-center">
        <div class="row">
          <table class="table table-hover table-striped">
			<thead>
				<tr>
					<th scope="col"></th>
					<th scope="col">Produto</th>
					<th scope="col">Valor</th>
					<th scope="col">Quantidade</th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$carrinho = getCarrinho();
					if ( is_null($carrinho) or count($carrinho) == 0): ?>
						<tr>
							<td colspan="4">Nenhum produto no Carrinho de Compras</td>
						</tr>
			   <?php else:
			   	foreach($carrinho as $item):
			   	?>
				<tr>
					<td><img style="width: 100px;" src=<?php echo $item['imagem'];?>></td>
					<td><h5><?php echo $item['NOME']  ?></h5></td>
					<td>R$ <?php echo $item['preco']; ?></td>
					<td><?php echo $item['quantidade']; ?></td>
					<td><a href="../organiza_carrinho.php?acao=excluir&id=<?php echo $item['ID_PRODUTO'];?>" class="btn btn-danger ">Excluir</a></td>
				</tr>
			  <?php endforeach; endif; ?>
			</tbody>
			<?php if ( !is_null($carrinho) or count($carrinho) > 0): ?>
				<tfoot>
					<tr>
						<td colspan="2" class="text-right">
							Total: 
						</td>
						<td>
							R$ <?php $total = calcular_total(); echo number_format($total, 2, ',', ''); ?>
						</td>
						<td></td>
					</tr>
					<tr>
						<td colspan="2 " class="text-right">
							Desconto: 
						</td>
						<td colspan="2">
							<form action="../organiza_carrinho.php">
								<input type="hidden" value="aplicar-desconto" name="acao">
								<input type="text" name="desconto" class="form-control">
							</form>
						</td>
					</tr>
					<tr>
						<td colspan="2" class="text-right">
							<samp class="foat-left">
								<a href="../organiza_carrinho.php?acao=limpar-carrinho">Limpar Carrinho</a>
							</samp>
							Valor Final: 
						</td>
						<td colspan="2">
							R$ <?php aplicar_desconto($total); echo number_format($total, 2, ',', ''); ?>
						</td>
					</tr>
				</tfoot>
			<?php endif?>
		</table>
		
		<div class="row justify-content-center">
			<a href="../encerra_pedido.php" class="btn btn-success" role="button">Encerrar pedido</a>		
		</div>
		<br>
	
          </table>
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