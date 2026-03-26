<?php

namespace utils;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Dotenv\Dotenv;

class Conexao {
    private static $entityManager;

    // captura o EntityManager que controla as entidades (doctrine)
    public static function getEntityManager() {
        // self é diferente do this. O this é usado para objetos. o self para atributos estáticos
        if (self::$entityManager === null) {
            $config = ORMSetup::createAttributeMetadataConfiguration(
                paths: [realpath(__DIR__ . '/../model')], // lugar onde estão as classes a serem mapeadas
                isDevMode: true, // altera a forma do cache de acordo com o ambiente (produção/desenvolvimento). Trocar pra false quando por no servidor real
            );
            // Estas duas linhas seguintes servem apenas para ler o .env
            $dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
            $dotenv->load();

            // Configuramos a conexão com o banco
            $connection = DriverManager::getConnection([
                'driver' => $_ENV['DB_DRIVER'],
                'host' => $_ENV['DB_HOST'],
                'port' => $_ENV['DB_PORT'],
                'dbname' => $_ENV['DB_NAME'],
                'user' => $_ENV['DB_USER'],
                'password' => $_ENV['DB_PASSWORD'],
            ], $config);

            self::$entityManager = new EntityManager($connection, $config);
        }
        return self::$entityManager;
    }
}