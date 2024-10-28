<?php

use Dotenv\Dotenv;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

beforeEach(function () {
    $this->client = new Client();
    (Dotenv::createImmutable(__DIR__ . '/../../'))->load();
});

test('deve cadastrar um novo usuário com uma requisição POST', function () {

    $url = $_ENV['BASE_URL'] . '/usuario';

    $data = [
        'nome' => 'Teste User',
    ];

    try {
        $response = $this->client->post($url, [
            'json' => $data,
        ]);

        $responseData = json_decode($response->getBody(), true);
        $this->assertEquals(201, $response->getStatusCode());
        expect($responseData)
            ->toBeArray()
            ->toHaveKey('message', 'Usuário criado com sucesso!');
    } catch (RequestException $e) {
        throw new Exception('Erro ao executar a requisição: ' . $e->getMessage());
    }
});


it('deve buscar um usuário com uma requisição GET', function () {
    $url = $_ENV['BASE_URL'] . '/usuario/43401852591'; // <- usuario de teste do docker/init.sql

    try {
        $response = $this->client->get($url);
        
        $responseData = json_decode($response->getBody(), true);

        expect($responseData)
            ->toBeArray()
            ->toHaveKey('usuario', ['nome' => 'teste', "nis" => "43401852591"]);
    } catch (RequestException $e) {
        throw new Exception('Erro ao executar a requisição: ' . $e->getMessage());
    }
});

it('deve buscar um usuário não existente', function () {
    $url = $_ENV['BASE_URL'] . '/usuario/4340185259';

    try {
        $this->client->get($url);
    } catch (RequestException $e) {
        $this->assertEquals(404, $e->getResponse()->getStatusCode());

        $responseData = json_decode($e->getResponse()->getBody(), true);
        expect($responseData)->toBeArray()->toHaveKey('message', 'Usuário nao encontrado');
    }
});
