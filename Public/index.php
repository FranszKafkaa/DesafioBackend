<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use Src\Controllers\UserController;
use Src\Database\DatabaseConnection;
use Src\Repositories\UserRepository;
use Src\Service\UserService;

(Dotenv::createImmutable(__DIR__ . '/../'))->load();

$db = new DatabaseConnection();
$userRepository = new UserRepository($db);
$userService = new UserService($userRepository);
$userController = new UserController($userService);


require_once './router.php';
