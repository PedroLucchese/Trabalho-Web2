<?php

include_once('FornecedorDao.php');
include_once('MySqlDao.php');

class MySqlFornecedorDao extends MySqlDao implements FornecedorDao {

    private $table_name = 'fornecedor';

    public function insere($fornecedor) {

        $query = "INSERT INTO " . $this->table_name .
        " (NOME, DESCRICAO, TELEFONE, EMAIL) VALUES" .
        " (:nome, :descricao, :telefone, :email)";

        $stmt = $this->conn->prepare($query);

        // bind values
        $stmt->bindValue(":nome", $fornecedor->getNome());
        $stmt->bindValue(":descricao", $fornecedor->getDescricao());
        $stmt->bindValue(":telefone", $fornecedor->getTelefone());
        $stmt->bindValue(":email", $fornecedor->getEmail());

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }

    }

    public function removePorId($id) {
        $query = "DELETE FROM " . $this->table_name .
        " WHERE ID_FORNECEDOR = :id";

        $stmt = $this->conn->prepare($query);

        // bind parameters
        $stmt->bindValue(':id', $id);

        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;
    }

    public function remove($fornecedor) {
        return removePorId($fornecedor->getId());
    }

    public function altera(&$fornecedor) {

        $query = "UPDATE " . $this->table_name .
        " SET NOME = :nome, DESCRICAO = :descricao, TELEFONE = :telefone, EMAIL = :email" .
        " WHERE ID_FORNECEDOR = :id";

        $stmt = $this->conn->prepare($query);

        // bind parameters
        $stmt->bindValue(":nome", $fornecedor->getNome());
        $stmt->bindValue(":descricao", $fornecedor->getDescricao());
        $stmt->bindValue(":telefone", $fornecedor->getTelefone());
        $stmt->bindValue(":email", $fornecedor->getEmail());
        $stmt->bindValue(':id', $fornecedor->getId());

        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;

    }

    public function buscaPorId($id) {

        $fornecedor = null;

        $query = "SELECT
                    ID_FORNECEDOR, NOME, DESCRICAO, TELEFONE, EMAIL
                FROM
                    " . $this->table_name . "
                WHERE
                    ID_FORNECEDOR = ?
                LIMIT
                    1 OFFSET 0";
        // echo $query;
        $stmt = $this->conn->prepare( $query );
        $stmt->bindValue(1, $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $fornecedor = new Fornecedor($row['ID_FORNECEDOR'],$row['NOME'], $row['DESCRICAO'], $row['TELEFONE'], $row['EMAIL']);
        }

        return $fornecedor;
    }

    public function buscaPorNome($nome) {

        $fornecedores = array();

        $query = "SELECT
                    ID_FORNECEDOR, NOME, DESCRICAO, TELEFONE, EMAIL
                FROM
                    " . $this->table_name . "
                WHERE
                    NOME LIKE '%{$nome}%'";

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $fornecedores[] = new Fornecedor($row['ID_FORNECEDOR'],$row['NOME'], $row['DESCRICAO'], $row['TELEFONE'], $row['EMAIL']);
        }

        return $fornecedores;
    }

    public function buscaPorDescricao($descricao) {
        
        $fornecedor = null;

        $query = "SELECT
                    ID_FORNECEDOR, NOME, DESCRICAO, TELEFONE, EMAIL
                FROM
                    " . $this->table_name . "
                WHERE
                    DESCRICAO CONTAINING(?)
                LIMIT
                    1 OFFSET 0";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindValue(1, $descricao);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $fornecedor = new Fornecedor($row['ID_FORNECEDOR'],$row['NOME'], $row['DESCRICAO'], $row['TELEFONE'], $row['EMAIL']);
        }

        return $fornecedor;
    }

    public function buscaTodos() {

        $fornecedor = array();

        $query = "SELECT
                    ID_FORNECEDOR, NOME, DESCRICAO, TELEFONE, EMAIL
                FROM
                    " . $this->table_name .
                    " ORDER BY ID_FORNECEDOR ASC";

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $fornecedor[] = new Fornecedor($row['ID_FORNECEDOR'],$row['NOME'], $row['DESCRICAO'], $row['TELEFONE'], $row['EMAIL']);
        }

        return $fornecedor;
    }
}
?>
