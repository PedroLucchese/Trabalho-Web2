<?php

include_once('UsuarioDao.php');
include_once('MySqlDao.php');

class MySqlUsuarioDao extends MySqlDao implements UsuarioDao {

    private $table_name = 'usuario';

    public function insere($usuario) {

        $query = "INSERT INTO " . $this->table_name .
        " (NOME, EMAIL, TELEFONE, SENHA, TIPO_USUARIO, NUM_CARTAO_CREDITO, CVV_CARTAO, NOME_TITULAR_CARTAO, DATA_VENCIMENTO_CARTAO, CPF) VALUES" .
        " (:nome, :email, :telefone, :senha, :tipo, :cartao, :cvv, :titular, :validade, :cpf)";

        $stmt = $this->conn->prepare($query);

        // bind values
        $stmt->bindParam(":nome", $usuario->getNome());
        $stmt->bindParam(":cpf", $usuario->getCpf());
        $stmt->bindParam(":email", $usuario->getEmail());
        $stmt->bindParam(":senha", $usuario->getSenha());
        $stmt->bindParam(":telefone", $usuario->getTelefone());
        $stmt->bindParam(":cartao", $usuario->getCartao());
        $stmt->bindParam(":titular", $usuario->getTitular());
        $stmt->bindParam(":cvv", $usuario->getCvv());
        $stmt->bindParam(":validade", $usuario->getValidade());
        $stmt->bindParam(":tipo", $usuario->getTipo());

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }

    }

    public function removePorId($id) {
        $query = "DELETE FROM " . $this->table_name .
        " WHERE ID_USUARIO = :id";

        $stmt = $this->conn->prepare($query);

        // bind parameters
        $stmt->bindParam(':id', $id);

        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;
    }

    public function remove($usuario) {
        return removePorId($usuario->getId());
    }

    public function altera(&$usuario) {

        $query = "UPDATE " . $this->table_name .
        " SET NOME = :nome, EMAIL = :email, TELEFONE = :telefone, SENHA = :senha, NUM_CARTAO_CREDITO = :cartao, CVV_CARTAO = :cvv, NOME_TITULAR_CARTAO = :titular, DATA_VENCIMENTO_CARTAO = :validade, CPF = :cpf" .
        " WHERE ID_USUARIO = :id";

        $stmt = $this->conn->prepare($query);

        // bind parameters
        $stmt->bindParam(":nome", $usuario->getNome());
        $stmt->bindParam(":cpf", $usuario->getCpf());
        $stmt->bindParam(":email", $usuario->getEmail());
        $stmt->bindParam(":senha", $usuario->getSenha());
        $stmt->bindParam(":telefone", $usuario->getTelefone());
        $stmt->bindParam(":cartao", $usuario->getCartao());
        $stmt->bindParam(":titular", $usuario->getTitular());
        $stmt->bindParam(":cvv", $usuario->getCvv());
        $stmt->bindParam(":validade", $usuario->getValidade());

        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;
    }

    public function buscaPorId($id) {

        $usuario = null;

        $query = "SELECT
                    ID_USUARIO, NOME, EMAIL, TELEFONE, SENHA, TIPO_USUARIO, NUM_CARTAO_CREDITO, CVV_CARTAO, NOME_TITULAR_CARTAO, DATA_VENCIMENTO_CARTAO, CPF
                FROM
                    " . $this->table_name . "
                WHERE
                    ID_USUARIO = ?
                LIMIT
                    1 OFFSET 0";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $usuario = new Usuario($row['ID_USUARIO'],$row['NOME'], $row['EMAIL'], $row['TELEFONE'], $row['SENHA'], $row['TIPO_USUARIO'], $row['NUM_CARTAO_CREDITO'], $row['CVV_CARTAO'], $row['NOME_TITULAR_CARTAO'], $row['DATA_VENCIMENTO_CARTAO'], $row['CPF']);
        }

        return $usuario;
    }

    public function buscaPorNome($nome) {

        $usuario = null;

        $query = "SELECT
                    ID_USUARIO, NOME, EMAIL, TELEFONE, SENHA, TIPO_USUARIO, NUM_CARTAO_CREDITO, CVV_CARTAO, NOME_TITULAR_CARTAO, DATA_VENCIMENTO_CARTAO, CPF
                FROM
                    " . $this->table_name . "
                WHERE
                    NOME = ?
                LIMIT
                    1 OFFSET 0";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $nome);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $usuario = new Usuario($row['ID_USUARIO'],$row['NOME'], $row['EMAIL'], $row['TELEFONE'], $row['SENHA'], $row['TIPO_USUARIO'], $row['NUM_CARTAO_CREDITO'], $row['CVV_CARTAO'], $row['NOME_TITULAR_CARTAO'], $row['DATA_VENCIMENTO_CARTAO'], $row['CPF']);
        }

        return $usuario;
    }

    public function buscaTodos() {

        $usuarios = array();

        $query = "SELECT
                    ID_USUARIO, NOME, EMAIL, TELEFONE, SENHA, TIPO_USUARIO, NUM_CARTAO_CREDITO, CVV_CARTAO, NOME_TITULAR_CARTAO, DATA_VENCIMENTO_CARTAO, CPF
                FROM
                    " . $this->table_name .
                    " ORDER BY ID_USUARIO ASC";

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $usuarios[] = new Usuario($row['ID_USUARIO'],$row['NOME'], $row['EMAIL'], $row['TELEFONE'], $row['SENHA'], $row['TIPO_USUARIO'], $row['NUM_CARTAO_CREDITO'], $row['CVV_CARTAO'], $row['NOME_TITULAR_CARTAO'], $row['DATA_VENCIMENTO_CARTAO'], $row['CPF']);
        }

        return $usuarios;
    }
}
?>
