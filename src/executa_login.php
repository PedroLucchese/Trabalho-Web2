<?php
// Métodos de acesso ao banco de dados
require "fachada.php";

// Inicia sessão
session_start();

// Recupera o email
$email = isset($_POST["login_email"]) ? addslashes(trim($_POST["login_email"])) : FALSE;

$senha = isset($_POST["senha_login"]) ? (trim($_POST["senha_login"])) : FALSE;


// Usuário não forneceu a senha ou o login
if(!$email || !$senha)
{
    echo "Você deve digitar seu email e senha!<br>"; 
    echo "<a href='/Trabalho-Web2/src/view/login.html'>Efetuar Login</a>";
    exit;
}

$dao = $factory->getUsuarioDao();
$usuario = $dao->buscaPorEmail($email);

$problemas = FALSE;

if($usuario) {
    // Agora verifica a senha
    if(!strcmp($senha, $usuario->getSenha()))
    {
        $_SESSION["ID_USUARIO"] = $usuario->getId();
        $_SESSION["NOME"] = stripslashes($usuario->getNome());
        $_SESSION["permissao"]= $usuario->getTipo();
        header("Location: ./view/index");
        exit;
    } else {
        $problemas = TRUE;
    }
} else {
    $problemas = TRUE;
}

if($problemas==TRUE) {   
    echo "<script type=\"text/javascript\">alert('Usuario ou senha incorretos')</script>";
    header("Location: ./view/login.html"); //TESTAR
    exit;
}
?>
