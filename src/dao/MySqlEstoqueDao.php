<?php

include_once('EstoqueDao.php');
include_once('MySqlDao.php');

class MySqlEstoqueDao extends MySqlDao implements EstoqueDao {

    private $table_name = 'estoque';

    public function salva(&$estoque) {

        $query = "INSERT INTO " . $this->table_name .
        " (idProduto, quantidade, preco) VALUES" .
        " (:idProduto, :quantidade, :preco) ON DUPLICATE KEY UPDATE " . 
        " quantidade = :quantidade, preco = :preco ";

        $stmt = $this->conn->prepare($query);

        // bind values
        $stmt->bindValue(":idProduto", $estoque->getId());
        $stmt->bindValue(":quantidade", $estoque->getQuantidade());
        $stmt->bindValue(":preco", $estoque->getPreco());

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }

    }
}
?>
