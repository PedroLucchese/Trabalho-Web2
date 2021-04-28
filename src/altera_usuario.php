<?php
include_once "fachada.php";

$id = @$_GET['id'];
$nome = @$_POST["nome"];
$email = @$_POST["email"];
$senha = @$_POST["senha"];
$telefone = @$_POST["telefone"];
$numCartao = @$_POST["cartaoCredito"];



$usuario = new Usuario($id, $nome, $email, $telefone, $senha, null, $numCartao, null, null, null, null);
$dao = $factory->getUsuarioDao();
$dao->altera($usuario);

header("Location: ./view/usuarios.php");
exit;

?>
