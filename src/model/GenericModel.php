<?php
// Os namespaces ajudam a organizar o código
// São semelhantes aos pacotes no Java
namespace model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\MappedSuperclass] // MappedSuperclass serve para referenciar uma superclasse
abstract class GenericModel
{
    #[ORM\Id] // Indica que esta coluna é uma chave primária
    #[ORM\GeneratedValue] // Indica que o campo deve ser gerado pelo banco (auto incremento)
    #[ORM\Column(type: 'integer')] // Indica o tipo da coluna
    private $id;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }



}