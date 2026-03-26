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

}