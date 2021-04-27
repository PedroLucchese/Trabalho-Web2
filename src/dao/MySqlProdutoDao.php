<?php

include_once('ProdutoDao.php');
include_once('MySqlDao.php');

class MySqlProdutoDao extends MySqlDao implements ProdutoDao {

    private $table_name = 'produto';

    public function insere($produto) {

        $query = "INSERT INTO " . $this->table_name .
        " (nome, descricao, idFornecedor) VALUES" . //Adicionar a parte do foto = :foto quando for o momento.
        " (:nome, :descricao, :idFornecedor)";

        $stmt = $this->conn->prepare($query);

        // bind values
        $stmt->bindParam(":nome", $produto->getNome());
        $stmt->bindParam(":descricao", $produto->getDescricao());
        $stmt->bindParam(":idFornecedor", $produto->getIdFornecedor());
        // $stmt->bindParam(":foto", $produto->getFoto());

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }

    }

    public function removePorId($id) {
        $query = "DELETE FROM " . $this->table_name .
        " WHERE id = :id";

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
        " SET nome = :nome, descricao = :descricao, idFornecedor = :idFornecedor" . //Adicionar a parte do foto = :foto quando for o momento.
        " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // bind parameters
        $stmt->bindParam(":nome", $produto->getNome());
        $stmt->bindParam(":descricao", $produto->getDescricao());
        $stmt->bindParam(":idFornecedor", $produto->getIdFornecedor());
        // $stmt->bindParam(":foto", $produto->getFoto());
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
                    id, nome, descricao, idFornecedor/*, foto*/
                FROM
                    " . $this->table_name . "
                WHERE
                    id = ?
                LIMIT
                    1 OFFSET 0";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $produto = new Produto($row['id'],$row['nome'], $row['descricao'], $row['idFornecedor']/*, $row['foto']*/);
        }

        return $produto;
    }

    public function buscaPorNome($nome) {

        $produto = null;

        $query = "SELECT
                    id, nome, descricao, idFornecedor/*, foto */
                FROM
                    " . $this->table_name . "
                WHERE
                    nome CONTAINING(?)
                LIMIT
                    1 OFFSET 0";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $nome);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $produto = new Produto($row['id'],$row['nome'], $row['descricao'], $row['idFornecedor']/*, $row['foto']*/);
        }

        return $produto;
    }

    public function buscaPorDescricao($descricao) {

        $produto = null;

        $query = "SELECT
                    id, nome, descricao, idFornecedor/*, foto*/
                FROM
                    " . $this->table_name . "
                WHERE
                    descricao CONTAINING(?)
                LIMIT
                    1 OFFSET 0";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $nome);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $produto = new Produto($row['id'],$row['nome'], $row['descricao'], $row['idFornecedor']/*, $row['foto']*/);
        }

        return $produto;
    }

    public function buscaTodos() {

        $produto = array();

        $query = "SELECT
                    id, nome, descricao, idFornecedor/*, foto*/
                FROM
                    " . $this->table_name .
                    " ORDER BY id ASC";

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $produto[] = new Produto($row['id'],$row['nome'], $row['descricao'], $row['idFornecedor']/*, $row['foto']*/);
        }

        return $produto;
    }
}
?>
