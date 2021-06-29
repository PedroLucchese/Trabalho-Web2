<?php require_once('../funcoes_carrinho.php'); ?>
<?php //print_r( getCarrinho() ); ?>
<?php
// require_once('database/consultas.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Carrinho de Compras</title>

	<!-- tags metas -->
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- CDN do bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> <!-- se tirar essa linha a pagina pega a tela inteira porém outras coisas param de funcionar  -->
    <link rel="stylesheet" href="../../css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
    <header>
        <?php
			include "../verifica.php";
			include_once "../fachada.php";
			include_once "navegacao.php" 

        ?>
    </header>
    <main>
        <section class="main">
		</br>
		<a href="consulta_produtos.php" class="btn btn-warning" role="button">Produtos</a>
		<a href="carrinho.php" class="btn btn-danger" role="button">Meu Carrinho</a>
		<h1 class="display-1">Produtos do Carrinho</h1>
		<hr>
		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th></th>
					<th>Produto</th>
					<th>Valor</th>
					<th>Quantidade</th>
					<th></th>
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
					<td><img src=<?php echo $item['imagem'];?>></td>
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
		<div class="col-md-10 col-lg-10" style="text-align: right"></div>
		<a href="../encerra_pedido.php" class="btn btn-success" role="button">Encerrar pedido</button>
	</div>
    </section>
    </main>
</body>
</html>