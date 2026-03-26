<?php
namespace model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "tb_endereco")]
class Endereco extends GenericModel {

    #[ORM\Column(type: 'string')]
    private $logradouro;

    #[ORM\Column(type: 'string', length: 6)]
    private $numero;

    #[ORM\Column(type: 'string')]
    private $bairro;

    #[ORM\Column(type: 'string')]
    private $cidade;

    public function getLogradouro()
    {
        return $this->logradouro;
    }

    public function setLogradouro($logradouro): void
    {
        $this->logradouro = $logradouro;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function setNumero($numero): void
    {
        $this->numero = $numero;
    }

    public function getBairro()
    {
        return $this->bairro;
    }

    public function setBairro($bairro): void
    {
        $this->bairro = $bairro;
    }

    public function getCidade()
    {
        return $this->cidade;
    }

    public function setCidade($cidade): void
    {
        $this->cidade = $cidade;
    }


}