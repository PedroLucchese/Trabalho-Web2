<?php
include_once "fachada.php";

$nome = isset($_POST["nome"]) ? addslashes(trim($_POST["nome"])) : FALSE;
$descricao = isset($_POST["descricao"]) ? addslashes(trim($_POST["descricao"])) : FALSE;
$email = isset($_POST["email"]) ? addslashes(trim($_POST["email"])) : FALSE;
$telefone = isset($_POST["telefone"]) ? addslashes(trim($_POST["telefone"])) : FALSE;

if (empty($nome) || empty($descricao) || empty($email) || empty($telefone)){
    echo "<script type=\"text/javascript\">alert('Voce nao preencheu todos os campos, verifique novamente!')</script>"; // redirecionamento nao ta funcionando, ajeitar isto.
    exit;
}

$fornecedor = new Fornecedor(null, $nome, $descricao, $telefone, $email);
$dao = $factory->getFornecedorDao();
$dao->insere($fornecedor);

header("../fornecedores.php");
exit;

?>
