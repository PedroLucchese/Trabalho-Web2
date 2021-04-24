<?php

include_once('DaoFactory.php');
include_once('MySqlUsuarioDao.php');
include_once('MySqlFornecedorDao.php');

class MySqlDaofactory extends DaoFactory {

    // specify your own database credentials
    private $username = "root";
    private $password = "";
    public $conn;

    // get the database connection
    public function getConnection(){

        $this->conn = null;

        try{
            //$this->conn = new PDO("pgsql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn = new PDO("mysql:host=localhost;port=3306;dbname=projetoJL", $this->username, $this->password);

      }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }

    public function getUsuarioDao() {

        return new MySqlUsuarioDao($this->getConnection());

    }

    public function getFornecedorDao() {
        return new MySqlFornecedorDao($this->getConnection());
    }
}
?>
