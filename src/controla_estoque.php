<?php
include_once "fachada.php";

$idProduto = isset($_POST["txtIdProduto"]) ? addslashes(trim($_POST["txtIdProduto"])) : FALSE;
$quantidade = isset($_POST["txtQtdProduto"]) ? addslashes(trim($_POST["txtQtdProduto"])) : FALSE;
$preco = isset($_POST["txtPrecoProduto"]) ? addslashes(trim($_POST["txtPrecoProduto"])) : FALSE;

if (empty($idProduto) || empty($quantidade) || empty($preco)){
    echo "<script type=\"text/javascript\">alert('Voce nao preencheu todos os campos, verifique novamente!')</script>";
    exit;
}

$daoProd = $factory->getProdutoDao();

if ($daoProd->buscaPorId($idProduto) == null)
{
    echo "<script type=\"text/javascript\">alert('Id de produto inexistente, verifique novamente!')</script>";
    exit;
}


$estoque = new Estoque($idProduto, $preco, $quantidade);
$dao = $factory->getEstoqueDao();
$dao->salva($estoque);

header("Location: ../controle_estoque.php");
exit;

?>