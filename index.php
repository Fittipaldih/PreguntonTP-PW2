<?php
include_once('Configuration.php');
$configuration = new Configuration();
$router = $configuration->getRouter();

$module = $_GET['module'] ?? 'user';
$method = $_GET['action'] ?? 'home';

$router->route($module, $method);





