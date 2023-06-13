<?php
include_once('Configuration.php');
include_once ('helpers/SessionManager.php');
include_once ('helpers/RolManager.php');

$sessionManager = new SessionManager();
$configuration = new Configuration();
$rolManager = new RolManager();

$router = $configuration->getRouter();

$module = $_GET['module'] ?? 'home';
$method = $_GET['action'] ?? 'home';

$idRol = $sessionManager->get('idRol');

if($rolManager->getAccessRol($idRol, $module, $method)){
    $router->route($module, $method);
} else {
    $router->route('home', $method);
}

/* ENTREGAS
- 05/06 Jugar partida
- 12/06 Ranking y ver perfil de otros usuarios
- 19/06 Rol editor, reportar pregunta y sugerir pregunta
- 26/06 Rol administrador y sus gráficos
- 03/07 Entrega
- 10/07 Entrega final
*/