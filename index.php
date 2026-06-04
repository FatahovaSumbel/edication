<?php
session_start();

// подключение
require_once __DIR__ . '/config/PDO.php';

// служебная часть
require_once 'Router.php';
$listRoute = require_once __DIR__ . '/config/route.php';
$router = new Router();
$router->add($listRoute);
$router->dispatch();