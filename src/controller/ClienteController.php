<?php

namespace controller;

use DateTime;
use Exception;
use dao\ClienteDAO;
use dao\CidadeDAO;
use model\Cliente;

class ClienteController
{

    public function novo()
    {
        $cliente = new Cliente();
        $cidades = CidadeDAO::listar();
        require __DIR__ . "/../view/cadastro-cliente.php";
    }

    public function cadastrar()
    {
        try {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
            $cpf = filter_input(INPUT_POST, "cpf", FILTER_SANITIZE_SPECIAL_CHARS);
            $data_nascimento = filter_input(INPUT_POST, "data_nascimento", FILTER_SANITIZE_SPECIAL_CHARS);

            $cliente = $id ? ClienteDAO::buscarId($id) : new Cliente();
            if(empty($cliente))
                throw new Exception("Cliente não encontrado.");
            $cliente->setNome($nome);
            $cliente->setCpf($cpf);
            $cliente->setDataNascimento(new DateTime($data_nascimento));
            ClienteDAO::salvar($cliente);
            header('Location:' . BASE_URL . '/clientes');
        } catch (Exception $ex) {
            echo 'Falha ao salvar cliente.' . $ex->getMessage();
            header('Location:' . BASE_URL . '/clientes/novo');
        } finally {
            exit;
        }

    }

    public function editar(array $params)
    {
        try {
            $id = $params['id'];
            $cliente = ClienteDAO::buscarId($id);
            if (empty($cliente)) {
                throw new Exception("Cliente não encontrado");
            }
        } catch (Exception $ex) {
            echo "Falha ao buscar cliente" . $ex->getMessage();
        } finally {
            require __DIR__ . "/../view/cadastro-cliente.php";
        }
    }


    public function listar()
    {
        try {
            $clientes = ClienteDAO::listar();
        } catch (Exception $ex) {
            echo "Falha ao listar os clientes" . $ex->getMessage();
        } finally {
            require __DIR__ . "/../view/lista-clientes.php";
        }
    }

    public function buscar(array $params)
    {
        try {
            $id = $params['id'];
            $cliente = ClienteDAO::buscarId($id);
            if (empty($cliente)) {
                throw new Exception("Cliente não encontrado");
            }
        } catch (Exception $ex) {
            echo "Falha ao buscar cliente" . $ex->getMessage();
        } finally {
            require __DIR__ . "/../view/visualizar-cliente.php";
        }
    }

    public function remover(array $params)
    {
        try {
            $id = $params['id'];
            $cliente = ClienteDAO::buscarId($id);
            if (empty($cliente)) {
                throw new Exception("Cliente não encontrado.");
            }
            ClienteDAO::deletar($cliente);
        } catch (Exception $ex) {
            echo "Falha ao remover cliente" . $ex->getMessage();
        } finally {
            header('Location: ' . BASE_URL . '/clientes');
            exit;
        }
    }
}
