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
            $_SESSION["mensagem_erro"] = 'Falha na listagem das cidades.';
            $_SESSION["mensagem_erro_detalhada"] = $ex->getMessage();
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

            // Se está sendo inserida uma imagem
            if(!empty($_FILES["imagem_cliente"]["tmp_name"])) {
                if (!empty($cliente->getUrlFotoPerfil())){
                    $imagemAntiga = $cliente->getUrlFotoPerfil();
                }
                $uploadResult = FileUpload::uploadImagem(
                    "clientes",
                    $_FILES["imagem_cliente"]["tmp_name"],
                    uniqid("imagem_do_cliente_") // imagem_do_cliente_XXXX
                );
                $cliente->setUrlFotoPerfil($uploadResult['secure_url']);
            }


            ClienteDAO::salvar($cliente);

            if(!empty($imagemAntiga)){
                FileUpload::deletarImagem("clientes", $imagemAntiga);
            }

            header('Location:' . BASE_URL . '/clientes');
            $_SESSION["mensagem_sucesso"] = "Cliente salvo com sucesso.";
        } catch (Exception $ex) {
            // Se eu tenho um URL da imagem, é porque ela foi salva
            // Se ela foi salva, mas aconteceu um erro, eu preciso apagá-la.
            if (!empty($uploadResult['secure_url'])){
                FileUpload::deletarImagem("clientes", $uploadResult['secure_url']);
            }
            $_SESSION["mensagem_erro"] = 'Falha ao salvar cliente.';
            $_SESSION["mensagem_erro_detalhada"] = $ex->getMessage();
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

            if(!empty($cliente->getUrlFotoPerfil())){
                FileUpload::deletarImagem("clientes", $cliente->getUrlFotoPerfil());
            }
            $_SESSION["mensagem_sucesso"] = "Cliente removido com sucesso.";
        } catch (Exception $ex) {
            $_SESSION["mensagem_erro"] = 'Falha ao remover cliente.';
            $_SESSION["mensagem_erro_detalhada"] = $ex->getMessage();
        } finally {
            header('Location: ' . BASE_URL . '/clientes');
            exit;
        }
    }
}
