<?php
// include_once "fachada.php";

$link = mysqli_connect("localhost", "root", "", "db_loja");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Declara Variavéis

$nome = mysqli_real_escape_string($link, $_REQUEST["fornec_nome"]);
$descricao = mysqli_real_escape_string($link, $_REQUEST["fornec_desc"]);
$email = mysqli_real_escape_string($link, $_REQUEST["fornec_email"]);
$telefone = mysqli_real_escape_string($link, $_REQUEST["fornec_tel"]);

if (empty($nome) || empty($descricao) || empty($email) || empty($telefone)){
    echo "<script type=\"text/javascript\">alert('Voce nao preencheu todos os campos, verifique novamente!')</script>";
    exit;
}

$sql = "INSERT INTO fornecedor VALUES (
                                        null,
                                        '$nome',
                                        '$descricao',
                                        '$telefone',
                                        '$email'

)";
if(mysqli_query($link, $sql)){
    echo "<script type=\"text/javascript\">alert('Fornecedor cadastrado com sucesso')</script>"; 
    echo "<a href='/Trabalho-Web2/src/view/index.html'>Volar a pagina principal</a>";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}


?>
