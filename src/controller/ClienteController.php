<?php

namespace controller;

use dao\ClienteDAO;

class ClienteController
{
    public function index() {
        $clientes = ClienteDAO::listar();
        require __DIR__ . '/../view/clientes.php';
    }

    public function buscar($id) {
        $cliente = ClienteDAO::buscarId($id);
        require __DIR__ . '/../view/cadastroCliente.php';
    }

}