<?php
include_once "fachada.php";

$nome = isset($_POST["nome_produto"]) ? addslashes(trim($_POST["nome_produto"])) : FALSE;
$descricao = isset($_POST["desc_produto"]) ? addslashes(trim($_POST["desc_produto"])) : FALSE;
$idFornecedor = isset($_POST["Fornecedor"]) ? addslashes(trim($_POST["Fornecedor"])) : FALSE;
$codigo = isset($_POST["cod_produto"]) ? addslashes(trim($_POST["cod_produto"])) : FALSE;
$nomeImagemTmp = basename($_FILES["img_produto"]["tmp_name"]);
$nomeImagemReal = basename($_FILES["img_produto"]["name"]);
$nomeImagemReal = str_replace(" ","_", $nomeImagemReal);


if (empty($nome) || empty($descricao) || empty($idFornecedor) || empty($nomeImagemReal) ){
    echo "<script type=\"text/javascript\">alert('Voce nao preencheu todos os campos, verifique novamente!')</script>"; 
    exit;
}

$produto = new Produto(null, $nome, $descricao, $idFornecedor, $codigo, "../uploads/$nomeImagemReal");
$dao = $factory->getProdutoDao();
$dao->insere($produto);

if (!file_exists("./uploads/"))
{
    mkdir("./uploads/");
}

if (move_uploaded_file($_FILES['img_produto']['tmp_name'], "./uploads/$nomeImagemReal")) {
    echo "Arquivo válido e enviado com sucesso.\n";
} else {
    echo "Erro ao enviar arquivo!\n";
}

header("Location: ../estoque.php");
exit;

?>
