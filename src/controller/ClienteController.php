<?php

namespace controller;

use DateTime;
use Exception;
use dao\ClienteDAO;
use dao\CidadeDAO;
use model\Cidade;
use model\Endereco;
use model\Cliente;
use utils\FileUpload;

class ClienteController
{

    public function novo()
    {
        try {
            $cliente = new Cliente();
            // Inserimos uma lista que vai preencher o Seect de Cidades
            $cidades = CidadeDAO::listar();
            require __DIR__ . "/../view/cadastro-cliente.php";
        } catch (Exception $ex) {
            echo 'Falha na listagem das cidades.' . $ex->getMessage();
            header("Location: " . BASE_URL . '/clientes');
        }
    }

    public function cadastrar()
    {
        try {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
            $cpf = filter_input(INPUT_POST, "cpf", FILTER_SANITIZE_SPECIAL_CHARS);
            $data_nascimento = filter_input(INPUT_POST, "data_nascimento", FILTER_SANITIZE_SPECIAL_CHARS);

            $cidade_id = filter_input(INPUT_POST, "cidade_id", FILTER_SANITIZE_NUMBER_INT);

            $cliente = $id ? ClienteDAO::buscarId($id) : new Cliente();
            if (empty($cliente))
                throw new Exception("Cliente não encontrado.");

            // Se a cidade existe, salva ela na variável
            // Se a cidade não existe, salva null na variável
            $cidade = $cidade_id ? CidadeDAO::buscarId($cidade_id) : null;
            if(empty($cidade) || $cidade === null)
                throw new Exception("Cidade não encontrada.");

            // Verificamos se o cliente possui endereço.
            // Se tiver, ele salva na variável
            // Se não tiver, cria um novo endereço e salva na variável
            $endereco = $cliente->getEndereco() ?? new Endereco();

            $endereco->setCidade($cidade);

            $cliente->setNome($nome);
            $cliente->setCpf($cpf);
            $cliente->setDataNascimento(new DateTime($data_nascimento));

            $cliente->setEndereco($endereco);

            $uploadResult = FileUpload::uploadImagem(
                "clientes",
                $_FILES["imagem_cliente"]["tmp_name"],
                uniqid("imagem_do_cliente_") // imagem_do_cliente_XXXX
            );

            $cliente->setUrlFotoPerfil($uploadResult['secure_url']);

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
            $cidades = CidadeDAO::listar();
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
