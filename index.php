<?php
include_once('Configuration.php');
$configuration = new Configuration();

$router = $configuration->getRouter();

$module = $_GET['module'] ?? 'home';
$method = $_GET['action'] ?? 'home';

$router->route($module, $method);

/* ENTREGAS
- 05/06 Jugar partida
- 12/06 Ranking y ver perfil de otros usuarios
- 19/06 Rol editor, reportar pregunta y sugerir pregunta
- 26/06 Rol administrador y sus gráficos
- 03/07 Entrega
- 10/07 Entrega final

Hacer QR y MAPA ubicacion, validar mail
*/