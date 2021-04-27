<?php
include_once "fachada.php";

$nome = isset($_POST["nome"]) ? addslashes(trim($_POST["nome"])) : FALSE;
$descricao = isset($_POST["descricao"]) ? addslashes(trim($_POST["descricao"])) : FALSE;
$idFornecedor = isset($_POST["idFornecedor"]) ? addslashes(trim($_POST["idFornecedor"])) : FALSE;


if (empty($nome) || empty($descricao) || empty($idFornecedor) ){
    echo "<script type=\"text/javascript\">alert('Voce nao preencheu todos os campos, verifique novamente!')</script>"; 
    exit;
}

$produto = new Produto(null, $nome, $descricao, $idFornecedor/);
$dao = $factory->getProdutoDao();
$dao->insere($produto);

header("../estoque.php");
exit;

?>
