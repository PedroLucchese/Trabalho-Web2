<?php
include_once "fachada.php";

$nome = isset($_POST["nome"]) ? addslashes(trim($_POST["nome"])) : FALSE;
$senha = isset($_POST["senha"]) ? addslashes(trim($_POST["senha"])) : FALSE;
$senhaConf = isset($_POST["senhaConf"]) ? addslashes(trim($_POST["senhaConf"])) : FALSE;
$email = isset($_POST["email"]) ? addslashes(trim($_POST["email"])) : FALSE;
$telefone = isset($_POST["telefone"]) ? addslashes(trim($_POST["telefone"])) : FALSE;
$cartaoCredito = isset($_POST["cartaoCredito"]) ? addslashes(trim($_POST["cartaoCredito"])) : FALSE;

if (empty($nome) || empty($senha) || empty($senhaConf) || empty($email) || empty($telefone) || empty($cartaoCredito)){
    echo "<script type=\"text/javascript\">alert('Voce nao preencheu todos os campos, verifique novamente!')</script>"; // <-- redirecionamento nao ta funcionando, ajeitar isto.
    exit;
}

if (strcmp($senha, $senhaConf)) {
    echo "<script type=\"text/javascript\">alert('As senhas nao estao iguais, verifique novamente!')</script>";
    header("../novousuario.php"); // <-- redirecionamento nao ta funcionando, ajeitar isto.
    exit;
}

$usuario = new Usuario(null, $senha, $nome, $telefone, $email, $cartaoCredito);
$dao = $factory->getUsuarioDao();
$dao->insere($usuario);

header("../usuarios.php");
exit;

?>