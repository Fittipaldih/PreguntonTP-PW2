<?php
include_once('Configuration.php');
$sessionManager = new SessionManager();
$configuration = new Configuration($sessionManager);

$router = $configuration->getRouter();

/*$module = $_GET['module'] ?? 'home';
$method = $_GET['action'] ?? 'home';

$router->route($module, $method);

*/
$module = $_GET['module'] ?? 'home';
$method = $_GET['action'] ?? 'home';

if($_SESSION["logueado"]){
    switch ($_SESSION["Id_rol"]){
        case 0:
            break;
        case 1:
            break;
        case 2:
            break;
        case 3:
            break;
    }
    $router->route($module, $method);

} else $router->route("home", "home");

//datos de session en el mosutache router
//clase estatica para redirigir
//llevar a SessionManager

