<?php
class Usuario {
    
    private $id;
    private $nome;
    private $email;
    private $telefone;
    private $senha;
    private $tipo;
    private $numCartao;
    private $cvvCartao;
    private $titularCartao;
    private $valCartao;
    private $cpf;

    public function __construct( $id, $nome, $email, $telefone, $senha, $tipo, $numCartao, $cvvCartao, $titularCartao, $valCartao, $cpf)
    {
        $this->id=$id;
        $this->nome=$nome;
        $this->email=$email;
        $this->telefone=$telefone;
        $this->senha=$senha;
        $this->tipo=$tipo;
        $this->numCartao=$numCartao;
        $this->cvvCartao=$cvvCartao;
        $this->titularCartao=$titularCartao;
        $this->valCartao=$valCartao;
        $this->cpf=$cpf;
        
    }

    public function getId() { return $this->id; }
    public function setId($id) {$this->id = $id;}

    public function getNome() { return $this->nome; }
    public function setNome($nome) {$this->nome = $nome;}

    public function getEmail() { return $this->email; }
    public function setEmail($email) {$this->email = $email;}

    public function getTelefone() { return $this->telefone; }
    public function setTelefone($telefone) {$this->telefone = $telefone;}

    public function getSenha() { return $this->senha; }
    public function setSenha($senha) {$this->senha = $senha;}

    public function getTipo() { return $this->tipo; }
    public function setTipo($tipo) {$this->tipo = $tipo;}

    public function getNumCartao() { return $this->numCartao; }
    public function setNumCartao($numCartao) {$this->numCartao = $numCartao;}

    public function getCvvCartao() { return $this->cvvCartao; }
    public function setCvvCartao($cvvCartao) {$this->cvvCartao = $cvvCartao;}

    public function getTitularCartao() { return $this->titularCartao; }
    public function setTitularCartao($titularCartao) {$this->titularCartao = $titularCartao;}

    public function getValCartao() { return $this->valCartao; }
    public function setValCartao($valCartao) {$this->valCartao = $valCartao;}

    public function getCpf() { return $this->cpf; }
    public function setCpf($cpf) {$this->cpf = $cpf;}
}
?>