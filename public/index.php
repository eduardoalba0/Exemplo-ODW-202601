<?php
// index.php
require "../vendor/autoload.php";

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->get('/clientes',        'ClienteController@index');
    $r->post('/clientes',       'ClienteController@salvar');
    $r->get('/clientes/{id}',   'ClienteController@buscar');
    $r->delete('/clientes/{id}','ClienteController@deletar');
});

$uri     = parse_url($_SERVER['REQUEST_URI'])['path'];
$basePath = rtrim(dirname(dirname($_SERVER['SCRIPT_NAME'])), '/');
$uri     = substr($uri, strlen($basePath)) ?: '/';
$method  = $_SERVER['REQUEST_METHOD'];

$route = $dispatcher->dispatch($method, $uri);

switch ($route[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        http_response_code(404);
        echo "Rota não encontrada";
        break;

    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        http_response_code(405);
        echo "Método não permitido";
        break;

    case FastRoute\Dispatcher::FOUND:
        [$controllerClass, $action] = explode('@', $route[1]);
        $params = $route[2];

        $controllerNamespace = "controller\\{$controllerClass}";
        $controller = new $controllerNamespace();
        $controller->$action($params);
        break;
}