<?php
class Usuario {
    
    private $id;
    private $nome;
    private $senha;
    private $telefone;
    private $email;
    private $cartaoCredito;

    public function __construct( $id, $senha, $nome, $telefone, $email, $cartaoCredito)
    {
        $this->id=$id;
        $this->senha=$senha;
        $this->nome=$nome;
        $this->telefone=$telefone;
        $this->email=$email;
        $this->cartaoCredito=$cartaoCredito;
    }

    public function getId() { return $this->id; }
    public function setId($id) {$this->id = $id;}

    public function getTelefone() { return $this->telefone; }
    public function setTelefone($telefone) {$this->telefone = $telefone;}

    public function getNome() { return $this->nome; }
    public function setNome($nome) {$this->nome = $nome;}

    public function getSenha() { return $this->senha; }
    public function setSenha($senha) {$this->senha = $senha;}

    public function getEmail() { return $this->email; }
    public function setEmail($email) {$this->email = $email;}

    public function getCartaoCredito() { return $this->cartaoCredito; }
    public function setCartaoCredito($cartaoCredito) {$this->cartaoCredito = $cartaoCredito;}
}
?>