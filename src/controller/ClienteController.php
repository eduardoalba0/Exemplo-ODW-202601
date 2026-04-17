<?php
namespace controller;

use dao\ClienteDAO;
use Exception;

class ClienteController{
    public function listar(){
       try{
           $clientes = ClienteDAO::listar();
       }catch (Exception $ex){
           echo "Falha ao listar os clientes" . $ex->getMessage();
       }finally{
           require __DIR__. "/../view/lista-clientes.php";
       }
    }

    public function buscar(array $params){
        try{
            $id = $params['id'];
            $cliente = ClienteDAO::buscarId($id);
            if(empty($cliente)){
                throw new Exception( "cliente nao encontrado");
            }
        }catch(Exception $ex){
            echo "Falha ao buscar cliente" . $ex->getMessage();
        } finally {
            require __DIR__. "/../view/visualizar_cliente.php";
        }
    }
}