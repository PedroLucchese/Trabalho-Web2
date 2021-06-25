<?php
// include_once "fachada.php";

// Tentativa de conexão do servidor MySQL. Supondo que você esteja executando o MySQL
$link = mysqli_connect("localhost", "root", "", "db_loja");

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$nome = mysqli_real_escape_string($link, $_REQUEST['cadastro_nome']);
$cpf = mysqli_real_escape_string($link, $_REQUEST['cadastro_cpf']);
$email = mysqli_real_escape_string($link, $_REQUEST ["cadastro_email"]);
$senha = mysqli_real_escape_string($link, $_REQUEST["cadastro_senha"]);
$telefone = mysqli_real_escape_string($link, $_REQUEST["cadastro_telefone"]);
$numCartao =mysqli_real_escape_string($link, $_REQUEST["cadastro_cartao"]);
$titularCartao = mysqli_real_escape_string($link, $_REQUEST["nome_titular"]);
$cvvCartao = mysqli_real_escape_string($link, $_REQUEST["cadastro_cvv"]);
$valCartao = mysqli_real_escape_string($link, $_REQUEST["data_vencimento"]);
$tipoUsuario = 1;

if (empty($nome) || empty($cpf) || empty($email) || empty($senha) || empty($telefone) || empty($numCartao) || empty($titularCartao) || empty($cvvCartao) || empty($valCartao)){
  echo "<script type=\"text/javascript\">alert('Voce nao preencheu todos os campos, verifique novamente!')</script>"; 
  echo "<a href='/Trabalho-Web2/src/view/cria_conta.php'>Voltar ao cadastro</a>";
  exit;
}

$sql = "INSERT INTO usuario VALUES (
                                        null,
                                        '$nome',
                                        '$email',
                                        '$telefone',
                                        '$senha',
                                        '$tipoUsuario',
                                        '$numCartao',
                                        '$cvvCartao',
                                        '$titularCartao',
                                        '$valCartao',
                                        '$cpf'
                                    )";
if(mysqli_query($link, $sql)){
    echo "<script type=\"text/javascript\">alert('Cadastro realizado com sucesso')</script>"; 
    echo "<a href='/Trabalho-Web2/src/view/index.php'>Volar a pagina principal</a>";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

?>