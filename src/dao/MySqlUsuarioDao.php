<?php

include_once('UsuarioDao.php');
include_once('MySqlDao.php');

class MySqlUsuarioDao extends MySqlDao implements UsuarioDao {

    private $table_name = 'usuario';

    public function insere($usuario) {

        $query = "INSERT INTO " . $this->table_name .
        " (nome, senha, email, telefone, cartaoCredito) VALUES" .
        " (:nome, :senha, :email, :telefone, :cartaoCredito)";

        $stmt = $this->conn->prepare($query);

        // bind values
        $stmt->bindParam(":nome", $usuario->getNome());
        $stmt->bindParam(":senha", $usuario->getSenha());
        $stmt->bindParam(":email", $usuario->getEmail());
        $stmt->bindParam(":telefone", $usuario->getTelefone());
        $stmt->bindParam(":cartaoCredito", $usuario->getCartaoCredito());

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

    public function remove($usuario) {
        return removePorId($usuario->getId());
    }

    public function altera(&$usuario) {

        $query = "UPDATE " . $this->table_name .
        " SET login = :login, senha = :senha, nome = :nome" .
        " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // bind parameters
        $stmt->bindParam(":login", $usuario->getLogin());
        $stmt->bindParam(":senha", ($usuario->getSenha()));
        $stmt->bindParam(":nome", $usuario->getNome());
        $stmt->bindParam(':id', $usuario->getId());

        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;
    }

    public function buscaPorId($id) {

        $usuario = null;

        $query = "SELECT
                    id, nome, telefone, senha, email, cartaoCredito
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
            $usuario = new Usuario($row['id'],$row['senha'], $row['nome'], $row['telefone'], $row['email'], $row['cartaoCredito']);
        }

        return $usuario;
    }

    public function buscaPorLogin($login) {

        $usuario = null;

        $query = "SELECT
                    id, nome, telefone, senha, email, cartaoCredito
                FROM
                    " . $this->table_name . "
                WHERE
                    nome = ?
                LIMIT
                    1 OFFSET 0";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $login);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $usuario = new Usuario($row['id'],$row['senha'], $row['nome'], $row['telefone'], $row['email'], $row['cartaoCredito']);
        }

        return $usuario;
    }

    public function buscaTodos() {

        $usuarios = array();

        $query = "SELECT
                    id, nome, telefone, senha, email, cartaoCredito
                FROM
                    " . $this->table_name .
                    " ORDER BY id ASC";

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $usuarios[] = new Usuario($row['id'],$row['senha'], $row['nome'], $row['telefone'], $row['email'], $row['cartaoCredito']);
        }

        return $usuarios;
    }
}
?>
