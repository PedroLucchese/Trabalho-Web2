<?php
include_once "fachada.php";

$id = @$_GET["id"];

$produto = new Produto($id, null, null, null, null);
$dao = $factory->getProdutoDao();
$dao->removePorId($id);

header("Location: ../estoque.php");
exit;

?>