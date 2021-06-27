<?php

    include_once('PedidoDao.php');
    include_once('MySqlDao.php');

class MySqlPedidoDao extends MySqlDao implements PedidoDao {

    private $table_name = 'pedido';

    public function criaPedido($carrinho)
    {
        $numeroPedido = $this->getLastNumero();

        foreach($carrinho as $item)
        {
            $queryItemPedido = "INSERT INTO itempedido VALUES (:idProduto, :numeroPedido, :quantidade, :preco)";

            $stmtItemPedido = $this->conn->prepare($queryItemPedido);

            $stmtItemPedido->bindValue(":idProduto", $item['id']);
            $stmtItemPedido->bindValue(":numeroPedido", $numeroPedido);
            $stmtItemPedido->bindValue(":quantidade", $item['quantidade']);
            $stmtItemPedido->bindValue(":preco", $item['preco'] * $item['quantidade']);

            if ($stmtItemPedido->execute()) {
                continue;
            } else {
                exit;
            }
        }

        $query = "INSERT INTO " . $this->table_name .
                "(numero, datapedido, dataentrega, situacao) VALUES " .
                "(:numero, :datapedido, :dataentrega, :situacao)";

        $stmt = $this->conn->prepare($query);

        $date = date("Y-m-d");

        $stmt->bindValue(":numero", $numeroPedido);
        $stmt->bindValue(":datapedido", $date);
        $stmt->bindValue(":dataentrega", date("Y-m-d", strtotime($date . ' + 7 days ')));
        $stmt->bindValue(":situacao", "Novo");

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    private function getLastNumero()
    {
        $query = "SELECT COALESCE(MAX(numero), 0) + 1 AS numero FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);

        if ($stmt->execute())
        {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return (int)$row['numero'];
        } else {
            return 0;
        }
    }
}
?>