<?php

namespace model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'tb_pedido')]
class Pedido extends GenericModel{

    #[ORM\Column(type: 'datetime', name: 'data_pedido')]
    private $dataPedido;

    #[ORM\ManyToOne(targetEntity: Cliente::class)]
    #[ORM\JoinColumn(name: "cliente_id")]
    private $cliente;

    #[ORM\ManyToMany(targetEntity: Produto::class)]
    #[ORM\JoinTable(name: "tb_produto_pedido")]
    #[ORM\JoinColumn(name: "pedido_id", referencedColumnName: "id")]
    #[ORM\InverseJoinColumn(name: "produto_id", referencedColumnName: "id")]
    private $produtos;

    public function getDataPedido()
    {
        return $this->dataPedido;
    }

    public function setDataPedido($dataPedido): void
    {
        $this->dataPedido = $dataPedido;
    }

    public function getCliente()
    {
        return $this->cliente;
    }

    public function setCliente($cliente): void
    {
        $this->cliente = $cliente;
    }

    public function getProdutos()
    {
        return $this->produtos;
    }

    public function setProdutos($produtos): void
    {
        $this->produtos = $produtos;
    }

}