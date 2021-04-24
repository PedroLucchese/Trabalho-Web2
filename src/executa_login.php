<?php
// Métodos de acesso ao banco de dados
require "fachada.php";

// Inicia sessão
session_start();

// Recupera o login
$login = isset($_POST["login"]) ? addslashes(trim($_POST["login"])) : FALSE;
// Recupera a senha, a criptografando em MD5
$senha = isset($_POST["senha"]) ? (trim($_POST["senha"])) : FALSE;
//$senha = isset($_POST["senha"]) ? trim($_POST["senha"]) : FALSE;

// Usuário não forneceu a senha ou o login
if(!$login || !$senha)
{
    echo "Você deve digitar sua senha e login!<br>"; //Tentar mostrar algo mais bonito.
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
        $_SESSION["id_usuario"] = $usuario->getId();
        $_SESSION["nome_usuario"] = stripslashes($usuario->getNome());
        //$_SESSION["permissao"]= $dados["postar"];
        header("Location: ../main.php");
        exit;
    } else {
        $problemas = TRUE;
    }
} else {
    $problemas = TRUE;
}

if($problemas==TRUE) {   //Fazer algo pra mostrar um alerta dizendo q o usuario ou senha estao incorretos
    header("Location: ../index.php");
    exit;
}
?>