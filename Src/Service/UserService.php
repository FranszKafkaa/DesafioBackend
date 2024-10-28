<?php

namespace Src\Service;

use Src\Models\User;
use Src\Repositories\UserRepository;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function saveUser($nome): string
    {
        
        try {
            $nis = $this->gerarNIS();
            $user = new User($nome, $nis);
            return $this->userRepository->save($user) ? $nis : "null";
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    public function acharPorNis($nis): string|User
    {
        $user = $this->userRepository->findByNis($nis);

        if ($user) {
            return $user;
        }

        return "Usuário nao encontrado";
    }

    public function gerarNIS(): string
    {
        $nisBase = '';
        for ($i = 0; $i < 10; $i++) {
            $nisBase .= mt_rand(0, 9);
        }

        $pesos = [3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        $soma = 0;

        for ($i = 0; $i < 10; $i++) {
            $soma += $nisBase[$i] * $pesos[$i];
        }

        $resto = $soma % 11;
        $digitoVerificador = ($resto < 2) ? 0 : 11 - $resto;

        $nis = $nisBase . $digitoVerificador;

        return $nis;
    }

}
