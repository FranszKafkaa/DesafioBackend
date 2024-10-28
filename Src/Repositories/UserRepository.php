<?php

namespace Src\Repositories;

use PDO;
use Src\Database\DatabaseConnection;
use Src\Models\User;

class UserRepository
{
    private PDO $db;

    public function __construct(DatabaseConnection $conn)
    {
        $this->db = $conn->getConnection();
    }

    public function save(User $user): bool
    {
        $query = $this->db->prepare("INSERT INTO user(nome, nis) VALUES (:nome, :nis)");
        $query->bindValue(':nome', $user->getNome());
        $query->bindValue(':nis', $user->getNis());

        return $query->execute();
    }

    public function findByNis(string $nis): User | null
    {
        $query = $this->db->prepare("select nome, nis from user where nis = :nis");
        $query->bindValue(':nis', $nis);
        $query->execute();

        $userData = $query->fetch(PDO::FETCH_ASSOC);

        if ($userData) {
            return new User($userData['nome'], $userData['nis']);
        }

        return null;
    }
}
