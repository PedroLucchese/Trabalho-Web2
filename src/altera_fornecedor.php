<?php
include_once "fachada.php";

$id = @$_GET['id'];
$nome = @$_POST["nome"];
$descricao = @$_POST["descricao"];
$telefone = @$_POST["telefone"];
$email = @$_POST["email"];



$fornecedor = new Fornecedor( $id, $nome, $descricao, $telefone, $email);
$dao = $factory->getFornecedorDao();
$dao->altera($fornecedor);

header("Location: ./view/fornecedores.php");
exit;

?>

