<?php 
// Inicia sessões 
include_once "comum.php";
		
if ( is_session_started() === FALSE ) {
    session_start();
}

error_log("LOGIN");

// Verifica se existe os dados da sessão de login 
if(!isset($_SESSION["ID_USUARIO"]) || !isset($_SESSION["NOME"]) && $_SESSION["permissao"] != 2) 
{ 
    error_log("USUÁRIO NÃO É ADMINISTRADOR- Voltando para Login");
    // Usuário administrador não logado!!
    header("Location: ./index.html");
    exit; 
}
?>