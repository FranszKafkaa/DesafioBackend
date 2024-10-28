<?php

namespace Src\Controllers;

use Src\Service\UserService;

class UserController
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function criarUsuario(): void
    {
        header('Content-Type: application/json');

        $data = json_decode(file_get_contents("php://input"), true);

        if (empty($data["nome"])) {
            http_response_code(400);
            echo json_encode(["message" => "Nome vazio"]);
            return;
        }

        try {
            $nis = $this->userService->saveUser($data["nome"]);
            http_response_code(201);
            echo json_encode(["message" => "Usuário criado com sucesso!", 'nis' => $nis]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(["message" => "Erro ao salvar " . $e->getMessage()]);
        }
    }

    public function acharPorNis($nis): void
    {
        if (empty($nis)) {
            http_response_code(400);
            echo json_encode(["message" => "NIS vazio"]);
            return;
        }

        try {
            $user = $this->userService->acharPorNis($nis);

            if (is_object($user)) {
                http_response_code(200);
                echo json_encode(["usuario" => ["nome" => $user->getNome(), "nis" => $user->getNis()]]);
                return;
            }

            http_response_code(404);
            echo json_encode(["message" => $user]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(["message" => "Erro ao consultar ". $e->getMessage()]);
        }
    }

}
