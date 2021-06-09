<?php

include_once('ProdutoDao.php');
include_once('MySqlDao.php');

class MySqlProdutoDao extends MySqlDao implements ProdutoDao {

    private $table_name = 'produto';

    public function insere($produto) {

        $query = "INSERT INTO " . $this->table_name .
        " (NOME, PRODUTO_DESCRICAO, ID_FORNECEDOR, COD_PRODUTO, imagem) VALUES" . //Adicionar foto = :foto na T2
        " (:nome, :descricao, :idFornecedor, :codigo, :imagem)";

        $stmt = $this->conn->prepare($query);

        // bind values
        $stmt->bindValue(":nome", $produto->getNome());
        $stmt->bindValue(":descricao", $produto->getDescricao());
        $stmt->bindValue(":idFornecedor", $produto->getIdFornecedor());
        $stmt->bindValue(":codigo", $produto->getCodProduto());
        $stmt->bindValue(":imagem", $produto->getImgProduto());


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
        $stmt->bindValue(':id', $id);

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
        $stmt->bindValue(":nome", $produto->getNome());
        $stmt->bindValue(":descricao", $produto->getDescricao());
        $stmt->bindValue(":idFornecedor", $produto->getIdFornecedor());
        $stmt->bindValue(":codigo", $produto->getCodProduto());
        $stmt->bindValue(':id', $produto->getId());

        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;
    }

    public function buscaPorId($id) {

        $produto = null;

        $query = "SELECT
                    ID_PRODUTO, NOME, PRODUTO_DESCRICAO, ID_FORNECEDOR, COD_PRODUTO, imagem
                FROM
                    " . $this->table_name . "
                WHERE
                    ID_PRODUTO = ?
                LIMIT
                    1 OFFSET 0";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindValue(1, $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $produto = new Produto($row['ID_PRODUTO'],$row['NOME'], $row['PRODUTO_DESCRICAO'], $row['ID_FORNECEDOR'], $row['COD_PRODUTO'], $row['imagem']);
        }

        return $produto;
    }

    public function buscaPorNome($nome) {

        $produto = null;

        $query = "SELECT
                    ID_PRODUTO, NOME, PRODUTO_DESCRICAO, ID_FORNECEDOR, COD_PRODUTO, imagem
                FROM
                    " . $this->table_name . "
                WHERE
                    NOME CONTAINING(?)
                LIMIT
                    1 OFFSET 0";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindValue(1, $nome);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $produto = new Produto($row['ID_PRODUTO'],$row['NOME'], $row['PRODUTO_DESCRICAO'], $row['ID_FORNECEDOR'], $row['COD_PRODUTO'], $row['imagem']);
        }

        return $produto;
    }

    public function buscaPorCod($descricao) {

        $produto = null;

        $query = "SELECT
                    ID_PRODUTO, NOME, PRODUTO_DESCRICAO, ID_FORNECEDOR, COD_PRODUTO, imagem
                FROM
                    " . $this->table_name . "
                WHERE
                    COD_PRODUTO CONTAINING(?)
                LIMIT
                    1 OFFSET 0";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindValue(1, $codigo);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $produto = new Produto($row['ID_PRODUTO'],$row['NOME'], $row['PRODUTO_DESCRICAO'], $row['ID_FORNECEDOR'], $row['COD_PRODUTO'], $row['imagem']);
        }

        return $produto;
    }

    public function buscaTodos() {

        $produto = array();

        $query = "SELECT
                    ID_PRODUTO, NOME, PRODUTO_DESCRICAO, ID_FORNECEDOR, COD_PRODUTO, imagem
                FROM
                    " . $this->table_name .
                    " ORDER BY ID_PRODUTO ASC";

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $produto[] = new Produto($row['ID_PRODUTO'],$row['NOME'], $row['PRODUTO_DESCRICAO'], $row['ID_FORNECEDOR'], $row['COD_PRODUTO'], $row['imagem']);
        }

        return $produto;
    }
}
?>
