<?php

include_once "comum.php";

if ( is_session_started() === FALSE ) {
    session_start();
    if(isset($_SESSION["NOME"])) {
        session_destroy();
        header("Location: ./view/login.html");
        exit();
    } 
} 
?>


		