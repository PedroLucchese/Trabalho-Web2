<?php
    include "../fachada.php";
    require_once("funcoes_carrinho.php");

    $carrinho = getCarrinho();
    if ( is_null($carrinho) or count($carrinho) == 0)
    {
        echo "<script>alert('Nenhum item no carrinho!')</script>";
        echo "<a href='../view/carrinho.php'>Clique aqui para voltar ao carrinho!</a>";
    } else {
        $daoEstoque = $factory->getEstoqueDao();
        $estoqueNovo = array();

        foreach($carrinho as $item)
        {
            if ($daoEstoque->verificaSeEstaEmEstoque($item["id"], $item["quantidade"]) == false)
            {
                $nomeProduto = $item["nome"];
                $qtdEstoque = $daoEstoque->getQuantidade($item["id"]);

                echo "<script>alert('Item \"$nomeProduto\" não está mais disponível em estoque! Quantidade em estoque: $qtdEstoque')</script>";
                echo "<a href='../view/carrinho.php'>Clique aqui para voltar ao carrinho!</a>";
                exit;
            } else {
                $estoqueNovo[] = new Estoque($item['id'], $item['preco'], $_SESSION['quantidade_estoque'] - $item['quantidade']);
                continue;
            }
        }

        $daoPedido = $factory->getPedidoDao();
        $daoPedido->criaPedido($carrinho);

        foreach($estoqueNovo as $estoque)
        {
            if (!$daoEstoque->salva($estoque))
            {
                error_log("Erro ao atualizar estoque após criação de pedido!");
                exit;
            }
        }

        limpar_carrinho();
        header("Location: ../view/home.php");
    }
?>