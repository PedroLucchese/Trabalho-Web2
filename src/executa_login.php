<?php
// Métodos de acesso ao banco de dados
require "fachada.php";

// Inicia sessão
session_start();

// Recupera o email
$email = isset($_POST["login_email"]) ? addslashes(trim($_POST["login_email"])) : FALSE;

$senha = isset($_POST["login_senha"]) ? (trim($_POST["login_senha"])) : FALSE;


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
        // TUDO OK! Agora, passa os dados para a sessão e redireciona o usuário
        //$_SESSION["ID_USUARIO"] = $usuario->getId();
        //$_SESSION["NOME"] = stripslashes($usuario->getNome());
        //$_SESSION["permissao"]= $dados["postar"];
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
