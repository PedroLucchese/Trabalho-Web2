<?php

include_once "../fachada.php";
include_once "verifica.php";

$acoes_permitidas = array('adicionar','excluir','aplicar-desconto','limpar-carrinho','cadastrar_produto');

function valida_acao_carrinho(string $acao): bool{
	global $acoes_permitidas;

	if(in_array($acao, $acoes_permitidas)){
		return TRUE;
	}
	return FALSE;
}

function adicionar_produto_carrinho(array $produto): bool{
	if ( !existe_produto( (int)$produto['id']) ) {
		$_SESSION['carrinho'][] = $produto;
		return TRUE;
	}
	return FALSE;
}

function excluir_produto_carrinho(int $id): bool{

	if( isset($_SESSION['carrinho']) and count($_SESSION['carrinho']) >0 ){
		foreach ($_SESSION['carrinho'] as $i => $item) {
			if ($item['id'] == $id){
				unset($_SESSION['carrinho'][$i]);
				return TRUE;
			}
		}
	}
	return FALSE;
}

function existe_produto(int $id): bool{

	if( isset($_SESSION['carrinho']) and count($_SESSION['carrinho']) >0 ){
		foreach ($_SESSION['carrinho'] as $item) {
			if ($item['id'] == $id){
				return TRUE;
			}
		}
	}
	return FALSE;
}

function getCarrinho(): ?array {
	return $_SESSION['carrinho'] ?? NULL;
}

function calcular_total(): float{

	$total = .0;
	if( isset($_SESSION['carrinho']) and count($_SESSION['carrinho']) >0 ){
		foreach ($_SESSION['carrinho'] as $i => $item) {
			$total += $item['preco'] * $item['quantidade'];
		}
	}
	return $total;
}

function aplicar_desconto(float &$valor){
	$porcentagem = $_SESSION['desconto'] ?? 0;
	$valor = $valor - ($valor * ($porcentagem/100) );

}

function limpar_carrinho():void{
	unset($_SESSION['carrinho']);
	unset($_SESSION['desconto']);
}
?>