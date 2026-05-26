<?php

namespace utils;

// Importação do SDK do Cloudinary
use Cloudinary\Cloudinary;
// Importação do DotEnv. Acesso ao arquivo .env
use Dotenv\Dotenv;
// Importa a classe de Exceptions pra tratamento de excessões
use Exception;

class FileUpload
{
    private static $storage;

    private static function getStorage()
    {
        // Verifica se o storage foi definido
        // Se não foi, ele cria uma nova "conexão" com o Cloudinary
        if (self::$storage === null) {
            // Carrega as variáveis de ambiente do arquivo .env
            $dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
            $dotenv->load();

            // Cria uma instância do Cloudinary
            // Através da URL de conexão presente no arquivo .env
            self::$storage = new Cloudinary($_ENV['CLOUDINARY_URL']);
        }
        // retorna a instância do Cloudinary
        return self::$storage;
    }

    public static function uploadImagem($pasta, $imagem, $idPublico)
    {
        try {
            // Captura a API de upload
            $uploadAPI = self::getStorage()->uploadApi();

            // Utiiza a função de upload da API para enviar a imagem
            // O segundo parâmetro é um array de opções para configurar o upload
            // 'folder' define a pasta onde a imagem será armazenada
            // 'public_id' define o nome público da imagem, que pode ser usado para acess
            $result = $uploadAPI->upload($imagem, [
                'folder' => $pasta,
                'public_id' => $idPublico,
                'overwrite' => true,
                'resource_type' => 'image'
            ]);

            return $result;
        } catch (Exception $e) {
            throw new Exception("Erro no upload da imagem: " . $e->getMessage());
        }
    }

    public static function deletarImagem($pasta, $publicUrl)
    {
        try {
            // Captura a API de upload
            $uploadAPI = self::getStorage()->uploadApi();
            // Extrai o public_id da URL da imagem
            $publicId = $pasta . "/" . pathinfo($publicUrl, PATHINFO_FILENAME);
            // Utiliza a função de destruição da API para deletar a imagem
            $result = $uploadAPI->destroy($publicId, ['resource_type' => 'image']);
            return $result;
        } catch (Exception $e) {
            throw new Exception("Erro ao deletar a imagem: " . $e->getMessage());
        }
    }
}