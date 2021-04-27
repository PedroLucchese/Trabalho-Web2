<?php
// Métodos de acesso ao banco de dados
require "fachada.php";

// Inicia sessão
session_start();

// Recupera o login
$email = isset($_POST["EMAIL"]) ? addslashes(trim($_POST["EMAIL"])) : FALSE;
// Recupera a senha, a criptografando em MD5
$senha = isset($_POST["SENHA"]) ? (trim($_POST["SENHA"])) : FALSE;
//$senha = isset($_POST["senha"]) ? trim($_POST["senha"]) : FALSE;

// Usuário não forneceu a senha ou o login
if(!$email || !$senha)
{
    echo "Você deve digitar seu email e senha!<br>"; //Tentar mostrar algo mais bonito.
    echo "<a href='../index.php'>Efetuar Login</a>";
    exit;
}

$dao = $factory->getUsuarioDao();
$usuario = $dao->buscaPorLogin($login);

$problemas = FALSE;
if($usuario) {
    // Agora verifica a senha
    if(!strcmp($senha, $usuario->getSenha()))
    {
        // TUDO OK! Agora, passa os dados para a sessão e redireciona o usuário
        $_SESSION["ID_USUARIO"] = $usuario->getId();
        $_SESSION["NOME"] = stripslashes($usuario->getNome());
        //$_SESSION["permissao"]= $dados["postar"];
        header("Location: ../index.html");
        exit;
    } else {
        $problemas = TRUE;
    }
} else {
    $problemas = TRUE;
}

if($problemas==TRUE) {   //Fazer algo pra mostrar um alerta dizendo q o usuario ou senha estao incorretos
    header("Location: ../src/view/login.html");
    exit;
}
?>
