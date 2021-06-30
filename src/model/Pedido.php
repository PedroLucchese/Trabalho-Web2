<?php

class Pedido {
    private $id;
    private $numero;
    private $DATA_EMISSAO;
    private $DATA_ENTREGA;
    private $situacao;

    public function __construct($numero, $DATA_EMISSAO, $DATA_ENTREGA, $situacao)
    {
        $this->numero=$numero;
        $this->DATA_EMISSAO=$DATA_EMISSAO;
        $this->DATA_ENTREGA=$DATA_ENTREGA;
        $this->situacao=$situacao;
    }

    public function getId() { return $this->id; }
    public function setId($numero) {$this->id = $numero;}

    public function getNumero() { return $this->numero; }
    public function setNumero($numero) {$this->numero = $numero;}

    public function getDataPedido() { return $this->DATA_EMISSAO; }
    public function setDataPedido($DATA_EMISSAO) {$this->DATA_EMISSAO = $DATA_EMISSAO;}

    public function getDataEntrega() { return $this->DATA_ENTREGA; }
    public function setDataEntrega($DATA_ENTREGA) {$this->DATA_ENTREGA = $DATA_ENTREGA;}

    public function getSituacao() { return $this->situacao; }
    public function setSituacao($situacao) {$this->situacao = $situacao;}

    public function getDadosParaJSON() {
        $dados_pedido = ['id' => $this->id, 'numero' => $this->numero, 'DATA_EMISSAO' => $this->DATA_EMISSAO, 'DATA_ENTREGA' => $this->DATA_ENTREGA, 'situacao' => $this->situacao];
        return $dados_pedido;
    }
}
