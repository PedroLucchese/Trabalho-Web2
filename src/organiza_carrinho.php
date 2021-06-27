<?php

require_once('./funcoes_carrinho.php');
require_once('../fachada.php');

$acao = (isset($_GET['acao']))? $_GET['acao'] : $_POST['acao'];

echo $acao;
//$acao = $_GET['acao'];
//$acao = $_POST['acao'];

if(valida_acao_carrinho($acao) ){
	$id = isset( $_GET['id'] )?  (int)$_GET['id']: FALSE;

	switch ($acao){
		case 'adicionar':
			if (!is_int($id) or $id == 0){
				die("Parametro Invalido!");
			}else{
				$qtdProduto = @$_POST['qtdProduto'];
                $dao = $factory->getProdutoDao();

				$produto = $dao->buscaPorIdParaCarrinho($id);
				$_SESSION['quantidade_estoque'] = $produto['quantidade'];
				$produto["quantidade"] = $qtdProduto;

				adicionar_produto_carrinho($produto);
				header('Location: ../view/carrinho.php');
				exit;
			}
		break;
		case 'excluir':
			if (!is_int($id) or $id == 0){
				die("Parametro Invalido!");
			}else{
				excluir_produto_carrinho($id);
				header('Location: ../view/carrinho.php');
				exit;
			}
		break;
		case 'aplicar-desconto':
			$desc = isset($_GET['desconto'])? (int)$_GET['desconto'] : 0;
			$_SESSION['desconto'] = $desc;
			header('Location: ../view/carrinho.php');
			exit; 	
		break;
		case 'limpar-carrinho':
			limpar_carrinho();
			header('Location: ../view/carrinho.php');
			exit; 
		break;
		case 'cadastrar_produto':
			cadastro_novo_produto($_POST);
			header('Location:produtos.php');
			exit;
		break;
	}

}else{
	die("Ação Invalida!");
}

?>