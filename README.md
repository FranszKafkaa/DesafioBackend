# Desafio - API de cadastro Usuários e NIS 

Este projeto é uma API simples escrita em PHP, que permite gerenciar usuários e produtos. A API foi construída do zero, seguindo os princípios de SOLID e utilizando o padrão de arquitetura MVC.

## Requisitos

- PHP 8.3
- Composer
- MySQL
- Docker (Opcional)

## Configuração do Ambiente (SEM DOCKER) 

### 1. Clonar o Repositório

```bash
git clone https://github.com/FranszKafkaa/DesafioBackend
cd desafio
```

### 3. Instalar Dependencias

```bash
composer install
```
### 4. Copie o .env.example para um .env
#### *Certifique-se de que os dados do banco MySql estejam corretos
```bash
cp .env.example .env
```
### 5. Configurar o projeto no docker

```bash
php -S 0.0.0.0:80 -t Public
```

## Rodar o Projeto No docker
### 1. Clonar o Repositório

```bash
git clone https://github.com/FranszKafkaa/DesafioBackend
cd desafio
```
### 2. Copie o .env.example para um .env
```bash
cp .env.example .env
```
### 3. Rode o projeto junto com o build
```bash
docker compose up --build
```

## Testes
### Para rodar os testes
```bash
./vendor/bin/pest
```
### Ou se estiver no Docker
```
docker-compose exec app vendor/bin/pest
```

## Endpoints

### O projeto conta com dois endpoint

### 1. Cadastrar um novo usuário
    URL: /usuario
    Método: POST

```json

{
    "nome": "Nome do Usuário",
}
```
Resposta:

    Status Code: 201

```json
{ 
    "message": "Usuário criado com sucesso!",
    "nis": "4340185259"
}
```

### 2. Procurar usuario por NIS

    URL: /usuario/{nis}
    Método: GET
    Resposta:
        Status Code: 200 (se encontrado) ou 404 (se não encontrado)
#### Body (encontrado):

```json
{
	"usuario": {
		"nome": "renan",
		"nis": "99736555217"
	}
}
```
#### Body (não encontrado):

```json
{
  "message": "Usuário não encontrado"
}
```