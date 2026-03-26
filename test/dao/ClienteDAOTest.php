<?php

namespace test\dao;

use dao\ClienteDAO;
use DateTime;
use model\Cliente;
use model\Contato;
use model\Endereco;
use PHPUnit\Framework\TestCase;

class ClienteDAOTest extends TestCase
{
    public function testInserir()
    {
        $cliente = new Cliente();
        $cliente->setNome("Henrique Pivetti");
        $cliente->setCpf("123.456.789-00");
        $cliente->setDataNascimento(new DateTime("2005-07-15"));
        $clienteInserido = ClienteDAO::salvar($cliente);

        $this->assertNotNull($clienteInserido->getId());


    }

    public function testInserirEndereco(){
        $cliente = new Cliente();
        $cliente->setNome("Isabela");
        $cliente->setCpf("123.456.789-00");
        $cliente->setDataNascimento(new DateTime("2005-07-15"));

        $endereco = new Endereco();
        $endereco->setLogradouro("Rua A");
        $endereco->setNumero("123");
        $endereco->setBairro("Bairro");
        $endereco->setCidade("Palmas");

        $cliente->setEndereco($endereco);

        $clienteInserido = ClienteDAO::salvar($cliente);

        $this->assertNotNull($clienteInserido->getEndereco());
    }

    public function testListar(){
        $clientes = ClienteDAO::listar();
        foreach ($clientes as $cliente){
            echo $cliente->getNome(). "\n";
        }

        $this->assertNotNull($clientes);
    }


    public function testAtualizar(){
        $cliente = new Cliente();
        $cliente->setNome("Maria");
        $cliente->setCpf("123.456.789-10");
        $cliente->setDataNascimento(new DateTime("1998-09-30"));
        $cliente = ClienteDAO::salvar($cliente);

        $clienteEditar = ClienteDAO::buscarId($cliente->getId());
        $clienteEditar->setNome("Maria Editada");
        $clienteEditada = ClienteDAO::salvar($clienteEditar);

        $this->assertEquals("Maria Editada", $clienteEditada->getNome());
        $this->assertEquals($clienteEditada->getId(), $cliente->getId());

    }

    public function testBuscarId(){
        $cliente = new Cliente();
        $cliente->setNome("Maria");
        $cliente->setCpf("123.456.789-10");
        $cliente->setDataNascimento(new DateTime("1998-09-30"));
        $cliente = ClienteDAO::salvar($cliente);

        $clienteBuscado = ClienteDAO::buscarId($cliente->getId());
        $this->assertNotNull($clienteBuscado->getId());
    }

    public function testDeletar(){
        $cliente = new Cliente();
        $cliente->setNome("Maria Deletar");
        $cliente->setCpf("123.456.789-10");
        $cliente->setDataNascimento(new DateTime("1998-09-30"));
        $cliente = ClienteDAO::salvar($cliente);

        $clienteDeletar = ClienteDAO::buscarId($cliente->getId());

        $idDeletar = $clienteDeletar->getId();
        ClienteDAO::deletar($clienteDeletar);

        $clienteDeletado = ClienteDAO::buscarId($idDeletar);
        $this->assertNull($clienteDeletado);

    }

    public function testBuscarNome(){
        $cliente = new Cliente();
        $cliente->setNome("Eduardo");
        $cliente->setCpf("123.456.789-10");
        $cliente->setDataNascimento(new DateTime("1998-09-30"));
        $cliente = ClienteDAO::salvar($cliente);

        $clientesBuscados = ClienteDAO::buscarNome("Eduardo");
        $this->assertNotEmpty($clientesBuscados);
    }

    public function testBuscarNome2(){
        $cliente = new Cliente();
        $cliente->setNome("Eduardo");
        $cliente->setCpf("123.456.789-10");
        $cliente->setDataNascimento(new DateTime("1998-09-30"));
        $cliente = ClienteDAO::salvar($cliente);

        $clientesBuscados = ClienteDAO::buscarNome2("Eduardo");
        $this->assertNotEmpty($clientesBuscados);
    }

    public function testBuscarNomeQueryBuilder(){
        $cliente = new Cliente();
        $cliente->setNome("Eduardo");
        $cliente->setCpf("123.456.789-10");
        $cliente->setDataNascimento(new DateTime("1998-09-30"));

        $clientesBuscados = ClienteDAO::buscarNomeQueryBuilder("Eduardo");
        $this->assertNotEmpty($clientesBuscados);
    }

    public function testBuscarNomeParecido(){
        $cliente = new Cliente();
        $cliente->setNome("Eduardo");
        $cliente->setCpf("123.456.789-10");
        $cliente->setDataNascimento(new DateTime("1998-09-30"));
        $cliente = ClienteDAO::salvar($cliente);

        $clientesBuscados = ClienteDAO::buscarNomeParecido("Edu");
        $this->assertNotEmpty($clientesBuscados[0]);
    }

    // INSERÇÕES COM RELACIONAMENTO

    public function testInserirEndereco2(){
        $cliente = new Cliente();
        $cliente->setNome("Maria");
        $cliente->setCpf("123.456.789-10");
        $cliente->setDataNascimento(new DateTime("1998-09-30"));

        $endereco = new Endereco();
        $endereco->setLogradouro("Rua x");
        $endereco->setNumero("1234");
        $endereco->setBairro("Bairro");
        $endereco->setCidade("Cidade");

        $cliente->setEndereco($endereco);
        ClienteDAO::salvar($cliente);
        $this->assertNotNull($cliente->getEndereco());
    }

    public function testInserirContatos(){
        $cliente = new Cliente();
        $cliente->setNome("Maria");
        $cliente->setCpf("123.456.789-10");
        $cliente->setDataNascimento(new DateTime("1998-09-30"));

        $contato1 = new Contato();
        $contato1->setTelefone("+55(46)88888-8888");
        $contato1->setEmail("ana@gmail.com");
        $contato1->setCliente($cliente);

        $contato2 = new Contato();
        $contato2->setTelefone("+55(46)99999-9999");
        $contato2->setEmail("eduardo@gmail.com");
        $contato2->setCliente($cliente);

        $contatos[] = $contato1;
        $contatos[] = $contato2;

        $cliente->setContatos($contatos);
        ClienteDAO::salvar($cliente);
        $this->assertNotEmpty($cliente->getContatos());
    }
}