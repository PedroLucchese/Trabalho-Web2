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
            $queryItemPedido = "INSERT INTO item_pedido VALUES (:ID_PRODUTO, :ID_PEDIDO, :QUANTIDADE, :PRECO)";
            
            $stmtItemPedido = $this->conn->prepare($queryItemPedido);

            $stmtItemPedido->bindValue(":ID_PRODUTO", $item['ID_PRODUTO']);
            $stmtItemPedido->bindValue(":ID_PEDIDO", $numeroPedido);
            $stmtItemPedido->bindValue(":QUANTIDADE", $item['quantidade']);
            $stmtItemPedido->bindValue(":PRECO", $item['preco'] * $item['quantidade']);
            error_log("ITEM: ".$item['ID_PRODUTO']);
            error_log("ID_PEDIDO: ".$numeroPedido);
            error_log("QUANTIDADE: ".$item['quantidade']);
            error_log("PRECO: ".$item['preco']); 
            error_log($queryItemPedido);
            if ($stmtItemPedido->execute()) {
                continue;
            } else {
                exit;
            }
        }

        $query = "INSERT INTO " . $this->table_name .
                "(numero,  DATA_EMISSAO, ID_USUARIO, DATA_ENTREGA, SITUACAO) VALUES " .
                "(:numero, :DATA_EMISSAO, :ID_USUARIO, :DATA_ENTREGA, :situacao)";

        $stmt = $this->conn->prepare($query);

        $date = date("Y-m-d");

        $stmt->bindValue(":numero", $numeroPedido);
        $stmt->bindValue(":DATA_EMISSAO", $date);
        $stmt->bindValue(":ID_USUARIO", $_SESSION['ID_USUARIO']);
        $stmt->bindValue(":DATA_ENTREGA", date("Y-m-d", strtotime($date . ' + 30 days ')));
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
	
	    public function buscaTodos()
    {
        $pedidos = array();

        $query = "select numero, DATA_EMISSAO, DATA_ENTREGA, situacao " .
        "from pedido ";
     
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        error_log("---> QUERY = " . $query);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $pedidos[] = new Pedido($numero, $DATA_EMISSAO, $DATA_ENTREGA, $situacao);
        }
        
        return $pedidos;
    }
	
	public function buscaPorId($numeroPedido)
    {
        $pedido = null;

        $query = "select numero, DATA_EMISSAO, DATA_ENTREGA, situacao " .
        "from pedido " .
        "where numero = ? " .
        "LIMIT 1 OFFSET 0";
     
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $numero);
        $stmt->execute();
     
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $pedido = new Pedido($row['numero'], $row['DATA_EMISSAO'], $row['DATA_ENTREGA'], $row['situacao']);
            return $pedido;
        } 
        return null;
    }
	
	    public function buscaPedidosJSON()
    {
        $pedidos = $this->buscaTodos();
        $pedidosJSON = array();
        foreach ($pedidos as $pedido) {
            $pedidosJSON[] = $pedido->getDadosParaJSON();
        }
        return stripslashes(json_encode($pedidosJSON,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    public function buscaPedidoJSON($numeroPedido)
    {
        $pedido = $this->buscaPorId($numeroPedido);
        if($pedido!=null) {
            return stripslashes(json_encode($pedido->getDadosParaJSON(),JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        } else {
            return null;
        }
    }
}
?>