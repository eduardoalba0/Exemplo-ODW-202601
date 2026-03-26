<?php

namespace dao;

use Exception;
use model\Cliente;
use utils\Conexao;

// Ele já herda todos os métodos do GenericDAO
class ClienteDAO extends GenericDAO
{
    protected static $modelClass = Cliente::class;

    public static function buscarNome($nome)
    {
        try {
            $em = Conexao::getEntityManager();
            $repository = $em->getRepository(Cliente::class);
            return $repository->findByNome($nome);
        } catch (Exception $ex) {
            throw new Exception("Falha ao buscar cliente pelo nome. " . $ex->getMessage());
        }
    }

    public static function buscarNome2($nome)
    {
        try {
            $em = Conexao::getEntityManager();
            $repository = $em->getRepository(Cliente::class);
            return $repository->findBy(['nome' => $nome]);
        } catch (Exception $ex) {
            throw new Exception("Falha ao buscar cliente pelo nome. " . $ex->getMessage());
        }
    }

    public static function buscarNomeQueryBuilder($nome){
        try {
            $em = Conexao::getEntityManager();
            $repository = $em->getRepository(Cliente::class);
            $queryBuilder = $repository->createQueryBuilder('c');
            $queryBuilder
                ->where('c.nome LIKE :nome')
                ->setParameter('nome', "%" . $nome . "%");
            return $queryBuilder->getQuery()->getResult();
        } catch (Exception $ex){
            throw new Exception("Falha ao buscar cliente pelo nome. " . $ex->getMessage());
        }
    }


    public static function buscarNomeParecido($nome){
        try {
            $em = Conexao::getEntityManager();
            $query = $em->createQuery("SELECT c FROM model\Cliente c WHERE c.nome LIKE :nome");
            $query->setParameter("nome", "%" . $nome . "%");
            return $query->getResult();
        } catch (Exception $ex){
            throw new Exception("Falha ao buscar cliente pelo nome. " . $ex->getMessage());
        }
    }
}