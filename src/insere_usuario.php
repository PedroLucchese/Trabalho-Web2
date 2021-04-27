<?php
include_once "fachada.php";

$nome = isset($_POST["cadastro_nome"]) ? addslashes(trim($_POST["cadastro_nome"])) : FALSE;
$cpf = isset($_POST["cadastro_cpf"]) ? addslashes(trim($_POST["cadastro_cpf"])) : FALSE;
$email = isset($_POST["cadastro_email"]) ? addslashes(trim($_POST["cadastro_email"])) : FALSE;
$senha = isset($_POST["cadastro_senha"]) ? addslashes(trim($_POST["cadastro_senha"])) : FALSE;
$telefone = isset($_POST["cadastro_telefone"]) ? addslashes(trim($_POST["cadastro_telefone"])) : FALSE;
$numCartao = isset($_POST["cadastro_cartao"]) ? addslashes(trim($_POST["cadastro_cartao"])) : FALSE;
$titularCartao = isset($_POST["nome_titular"]) ? addslashes(trim($_POST["nome_titular"])) : FALSE;
$cvvCartao = isset($_POST["cadastro_cvv"]) ? addslashes(trim($_POST["cadastro_cvv"])) : FALSE;
$valCartao = isset($_POST["data_vencimento"]) ? addslashes(trim($_POST["data_vencimento"])) : FALSE;
$tipoUsuario = 1;

if (empty($nome) || empty($cpf) || empty($email) || empty($senha) || empty($telefone) || empty($numCartao) || empty($titularCartao) || empty($cvvCartao) || empty($valCartao)){
    echo "<script type=\"text/javascript\">alert('Voce nao preencheu todos os campos, verifique novamente!')</script>";
    exit;
}

$usuario = new Usuario(null, $nome, $cpf, $email, $senha, $telefone, $numCartao, $titularCartao, $cvvCartao, $valCartao, $tipoUsuario);
$dao = $factory->getUsuarioDao();
$dao->insere($usuario);

header("/usuarios.php");
exit;

?>