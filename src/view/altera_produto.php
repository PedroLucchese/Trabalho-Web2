<?php
include_once "../fachada.php";

$id = @$_GET['id'];
$nome = @$_POST["nome"];
$descricao = @$_POST["descricao"];
$codigo = @$_POST["codigo"];


$produto = new Produto($id, $nome, $descricao, null, $codigo);
$dao = $factory->getProdutoDao();
$dao->altera($produto);

header("Location: ./produtos.php");
exit;

?>
