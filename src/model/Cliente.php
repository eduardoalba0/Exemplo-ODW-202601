<?php

namespace model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity] // Entity funciona pra gente referenciar uma tabela. O Doctrine vai ler e entender que deseamos criar uma.
#[ORM\Table(name: 'tb_cliente')] // Table funciona pra gente mudar o nome da tabela
class Cliente extends GenericModel
{

    #[ORM\Column(type: 'string')] // Column funciona pra gente definir as caracteristicas da nossa coluna
    private $nome;

    #[ORM\Column(type: 'string')]
    private $cpf;

    #[ORM\Column(type: 'date')] // o date só guarda a data. Se quer a hora também, deve usar o datetime
    private $dataNascimento;

    #[ORM\Column(type: 'string', nullable: true)]
    private $urlFotoPerfil;

    // OneToOne referencia um relacionamento um-para-um
    // Neste caso, um cliente vai ter um endereço. Neste tipo de relacionamento você pode escolher quem vai guardar a chave estrangeira
    // targetEntity representa o "tipo de dado" deste campo, que no caso é a classe Endereço relacionada
    // cascade indica quais operações serão propagadas em cascata (CASCADE), como ao remover um cliente
    // orphanRemoval impede que tenham endereços 'órfãos', ou seja, sem um cliente associado
    #[ORM\OneToOne(targetEntity: Endereco::class,
        cascade: ['all'],
        orphanRemoval: true,
        fetch: 'EAGER')]
    #[ORM\JoinColumn(name: "endereco_id")]
    private $endereco;

    // OneToMany referencia um relacionamento um-para-muitos
    // Neste caso, um cliente tem varios contatos, mas os contatos tem apenas 1 cliente cada
    // Este tipo de relacionamento pode ser implementado de forma bidirecional, como estamos fazendo aqui.
    // O relacionamento bidirecional permite que tenhamos uma "lista" de todos os contatos associados a este cliente.
    // o mappedBy indica o nome da CLASSE que representa a chave estrangeira. Aqui, quer dizer que dentro de cada contato, haverá um cliente (chave estrangeira)
    // targetEntity representa o "tipo de dado" da lista. que no caso é a classe Contato relacionada
    // cascade indica quais operações serão propagadas em cascata (CASCADE), como ao remover um cliente
    // orphanRemoval impede que tenham contatos 'órfãos', ou seja, sem um cliente associado
    #[ORM\OneToMany(mappedBy: "cliente",
        targetEntity: Contato::class,
        cascade: ["all"],
        orphanRemoval: true, fetch: 'LAZY')]
    private $contatos;

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome): void
    {
        $this->nome = $nome;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setCpf($cpf): void
    {
        $this->cpf = $cpf;
    }

    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }

    public function setDataNascimento($dataNascimento): void
    {
        $this->dataNascimento = $dataNascimento;
    }

    public function getUrlFotoPerfil()
    {
        return $this->urlFotoPerfil;
    }

    public function setUrlFotoPerfil($urlFotoPerfil): void
    {
        $this->urlFotoPerfil = $urlFotoPerfil;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function setEndereco($endereco): void
    {
        $this->endereco = $endereco;
    }

    public function getContatos()
    {
        return $this->contatos;
    }

    public function setContatos($contatos): void
    {
        $this->contatos = $contatos;
    }

}
