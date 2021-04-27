<?php
include_once "fachada.php";

$id = @$_GET["id"];

$usuario = new Usuario($id, null, null, null, null, null, null, null, null, null, null);
$dao = $factory->getUsuarioDao();
$dao->removePorId($id);

header("Location: ./view/usuarios.php");
exit;

?>