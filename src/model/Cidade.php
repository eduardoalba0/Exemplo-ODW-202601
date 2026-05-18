<?php

namespace model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'tb_cidade')]
class Cidade extends GenericModel
{
    #[ORM\Column(type: 'string', nullable: false)]
    private $nome;

    #[ORM\Column(type: 'string', nullable: false)]
    private $estado;

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome): void
    {
        $this->nome = $nome;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado): void
    {
        $this->estado = $estado;
    }

}