<?php

namespace Src\Models;

class User
{
    private String $nome;
    private String $nis;

    public function __construct($nome, $nis)
    {
        $this->nome = $nome;
        $this->nis = $nis;
    }

    public function getNome(): String
    {
        return $this->nome;
    }

    public function getNis(): String
    {
        return $this->nis;
    }

    public function setNome(String $nome)
    {
        $this->nome = $nome;
    }
}
