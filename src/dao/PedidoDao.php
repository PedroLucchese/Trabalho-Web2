<?php
interface PedidoDao {
    public function criaPedido($carrinho);

    public function buscaTodos();

    public function buscaPorId($numeroPedido);

    public function buscaPedidosJSON();

    public function buscaPedidoJSON($numeroPedido);
}
?>