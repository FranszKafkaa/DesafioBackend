<?php
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($_SERVER['REQUEST_URI']) {
    case '/usuario':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userController->criarUsuario();
        }
        break;

    case (preg_match('/^\/usuario\/(\d+)$/', $_SERVER['REQUEST_URI'], $matches) ? true : false):
        $userController->acharPorNis($matches[1]);
        break;
    default:
        http_response_code(404);
}
