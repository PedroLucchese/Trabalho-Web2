<?php
class Produto {
    
    private $id;
    private $nome;
    private $descricao;
    private $idFornecedor;
    private $codigo;

    public function __construct( $id, $nome, $descricao, $idFornecedor, $codigo)
    {
        $this->id=$id;
        $this->descricao=$descricao;
        $this->nome=$nome;
        $this->idFornecedor=$idFornecedor;
        $this->codigo=$codigo;
    }

    public function getId() { return $this->id; }
    public function setId($id) {$this->id = $id;}

    public function getNome() { return $this->nome; }
    public function setNome($nome) {$this->nome = $nome;}

    public function getDescricao() { return $this->descricao; }
    public function setDescricao($descricao) {$this->descricao = $descricao;}

    public function getIdFornecedor() { return $this->idFornecedor; }
    public function setIdFornecedor($idFornecedor) {$this->idFornecedor = $idFornecedor;}

    public function getCodProduto() { return $this->codigo; }
    public function setCodProduto($codigo) {$this->codigo = $codigo;}

}
?>