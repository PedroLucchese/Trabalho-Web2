<?php
include_once "fachada.php";

$nome = isset($_POST["nome_produto"]) ? addslashes(trim($_POST["nome_produto"])) : FALSE;
$descricao = isset($_POST["desc_produto"]) ? addslashes(trim($_POST["desc_produto"])) : FALSE;
$idFornecedor = isset($_POST["Fornecedor"]) ? addslashes(trim($_POST["Fornecedor"])) : FALSE;
$codigo = isset($_POST["cod_produto"]) ? addslashes(trim($_POST["cod_produto"])) : FALSE;


if (empty($nome) || empty($descricao) || empty($idFornecedor) ){
    echo "<script type=\"text/javascript\">alert('Voce nao preencheu todos os campos, verifique novamente!')</script>"; 
    exit;
}

$produto = new Produto(null, $nome, $descricao, $idFornecedor, $codigo);
$dao = $factory->getProdutoDao();
$dao->insere($produto);

header("../estoque.php");
exit;

?>
