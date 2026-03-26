<?php

namespace model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'tb_contato')]
class Contato extends GenericModel
{
    #[ORM\Column(type: 'string')]
    private $telefone;

    #[ORM\Column(type: 'string')]
    private $email;

    #[ORM\Column(type: 'string', nullable: true)]
    private $whatsapp;

    #[ORM\ManyToOne(targetEntity: Cliente::class)]
    #[ORM\JoinColumn(name: "cliente_id")]
    private $cliente;

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone($telefone): void
    {
        $this->telefone = $telefone;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function getWhatsapp()
    {
        return $this->whatsapp;
    }

    public function setWhatsapp($whatsapp): void
    {
        $this->whatsapp = $whatsapp;
    }

    public function getCliente()
    {
        return $this->cliente;
    }

    public function setCliente($cliente): void
    {
        $this->cliente = $cliente;
    }
}