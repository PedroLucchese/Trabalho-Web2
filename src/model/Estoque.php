<?php
class Estoque {
    
    private $idProduto;
    private $preco;
    private $quantidade;

    public function __construct( $idProduto, $preco, $quantidade)
    {
        $this->idProduto=$idProduto;
        $this->preco=$preco;
        $this->quantidade=$quantidade;
    }

    public function getId() { return $this->idProduto; }
    public function setId($idProduto) {$this->idProduto = $idProduto;}

    public function getPreco() { return $this->preco; }
    public function setPreco($preco) {$this->preco = $preco;}

    public function getQuantidade() { return $this->quantidade; }
    public function setQuantidade($quantidade) {$this->quantidade = $quantidade;}
}
?>