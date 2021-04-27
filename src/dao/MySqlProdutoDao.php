<?php

include_once('ProdutoDao.php');
include_once('MySqlDao.php');

class MySqlProdutoDao extends MySqlDao implements ProdutoDao {

    private $table_name = 'produto';

    public function insere($produto) {

        $query = "INSERT INTO " . $this->table_name .
        " (NOME, PRODUTO_DESCRICAO, ID_FORNECEDOR, COD_PRODUTO) VALUES" . //Adicionar foto = :foto na T2
        " (:nome, :descricao, :idFornecedor, :codigo)";

        $stmt = $this->conn->prepare($query);

        // bind values
        $stmt->bindParam(":nome", $produto->getNome());
        $stmt->bindParam(":descricao", $produto->getDescricao());
        $stmt->bindParam(":idFornecedor", $produto->getIdFornecedor());
        $stmt->bindParam(":codigo", $produto->getCodProduto());


        if($stmt->execute()){
            return true;
        }else{
            return false;
        }

    }

    public function removePorId($id) {
        $query = "DELETE FROM " . $this->table_name .
        " WHERE ID_PRODUTO = :id";

        $stmt = $this->conn->prepare($query);

        // bind parameters
        $stmt->bindParam(':id', $id);

        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;
    }

    public function remove($produto) {
        return removePorId($produto->getId());
    }

    public function altera(&$produto) {

        $query = "UPDATE " . $this->table_name .
        " SET NOME = :nome, PRODUTO_DESCRICAO = :descricao, ID_FORNECEDOR = :idFornecedor, COD_PRODUTO = :codigo" . 
        " WHERE ID_PRODUTO = :id";

        $stmt = $this->conn->prepare($query);

        // bind parameters
        $stmt->bindParam(":nome", $produto->getNome());
        $stmt->bindParam(":descricao", $produto->getDescricao());
        $stmt->bindParam(":idFornecedor", $produto->getIdFornecedor());
        $stmt->bindParam(":codigo", $produto->getCodProduto());
        $stmt->bindParam(':id', $produto->getId());

        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;
    }

    public function buscaPorId($id) {

        $produto = null;

        $query = "SELECT
                    ID_PRODUTO, NOME, PRODUTO_DESCRICAO, ID_FORNECEDOR, COD_PRODUTO
                FROM
                    " . $this->table_name . "
                WHERE
                    ID_PRODUTO = ?
                LIMIT
                    1 OFFSET 0";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $produto = new Produto($row['ID_PRODUTO'],$row['NOME'], $row['PRODUTO_DESCRICAO'], $row['ID_FORNECEDOR'], $row['COD_PRODUTO']);
        }

        return $produto;
    }

    public function buscaPorNome($nome) {

        $produto = null;

        $query = "SELECT
                    ID_PRODUTO, NOME, PRODUTO_DESCRICAO, ID_FORNECEDOR, COD_PRODUTO
                FROM
                    " . $this->table_name . "
                WHERE
                    NOME CONTAINING(?)
                LIMIT
                    1 OFFSET 0";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $nome);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $produto = new Produto($row['ID_PRODUTO'],$row['NOME'], $row['PRODUTO_DESCRICAO'], $row['ID_FORNECEDOR'], $row['COD_PRODUTO']);
        }

        return $produto;
    }

    public function buscaPorDescricao($descricao) {

        $produto = null;

        $query = "SELECT
                    ID_PRODUTO, NOME, PRODUTO_DESCRICAO, ID_FORNECEDOR, COD_PRODUTO
                FROM
                    " . $this->table_name . "
                WHERE
                    PRODUTO_DESCRICAO CONTAINING(?)
                LIMIT
                    1 OFFSET 0";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $descricao);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $produto = new Produto($row['ID_PRODUTO'],$row['NOME'], $row['PRODUTO_DESCRICAO'], $row['ID_FORNECEDOR'], $row['COD_PRODUTO']);
        }

        return $produto;
    }

    public function buscaTodos() {

        $produto = array();

        $query = "SELECT
                    ID_PRODUTO, NOME, PRODUTO_DESCRICAO, ID_FORNECEDOR, COD_PRODUTO
                FROM
                    " . $this->table_name .
                    " ORDER BY ID_PRODUTO ASC";

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $produto[] = new Produto($row['ID_PRODUTO'],$row['NOME'], $row['PRODUTO_DESCRICAO'], $row['ID_FORNECEDOR'], $row['COD_PRODUTO']);
        }

        return $produto;
    }
}
?>
