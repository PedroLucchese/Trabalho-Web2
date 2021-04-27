<?php
include_once "fachada.php";

$id = @$_GET["ID_USUARIO"];
$nome = @$_GET["NOME"];
$email = @$_GET["EMAIL"];
$senha = @$_GET["SENHA"];
$telefone = @$_GET["TELEFONE"];
$numCartao = @$_GET["NUM_CARTAO_CREDITO"];
$titularCartao = @$_GET["NOME_TITULAR_CARTAO"];
$cvvCartao = @$_GET["CVV_CARTAO"];
$valCartao = @$_GET["DATA_VENCIMENTO_CARTAO"];
$tipoUsuario = @$_GET["TIPO_USUARIO"];


$usuario = new Usuario($id, $nome, $cpf, $email, $senha, $telefone, $numCartao, $titularCartao, $cvvCartao, $valCartao, $tipoUsuario);
$dao = $factory->getUsuarioDao();
$dao->altera($usuario);

header("Location: ../usuarios.php");
exit;

?>
