<?php
include_once "fachada.php";

$id = @$_GET["id"];

$fornecedor = new Fornecedor($id, null, null, null, null);
$dao = $factory->getFornecedorDao();
$dao->removePorId($id);

header("Location: ../fornecedor.php");
exit;

?>