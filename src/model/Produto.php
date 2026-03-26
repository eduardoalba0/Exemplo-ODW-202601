<?php

namespace model;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "tb_produto")]
class Produto extends GenericModel{
    #[ORM\Column(type: 'string')]
    private $nome;

    #[ORM\Column(type: 'decimal', precision: 2)]
    private $preco;

    #[ORM\Column(type: 'string')]
    private $descricao;

    #[ORM\ManyToMany(targetEntity: Pedido::class, mappedBy: "produtos")]
    private $pedidos;

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome): void
    {
        $this->nome = $nome;
    }

    public function getPreco()
    {
        return $this->preco;
    }

    public function setPreco($preco): void
    {
        $this->preco = $preco;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao): void
    {
        $this->descricao = $descricao;
    }

    public function getPedidos()
    {
        return $this->pedidos;
    }

    public function setPedidos($pedidos): void
    {
        $this->pedidos = $pedidos;
    }

}