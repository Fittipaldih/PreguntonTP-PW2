<?php
include_once('helpers/MySqlDatabase.php');
include_once("helpers/MustacheRender.php");
include_once('helpers/Router.php');

include_once ("model/UserModel.php");
include_once ("model/HomeModel.php");
include_once ("model/RegistroModel.php");



include_once('controller/UserController.php');
include_once('controller/HomeController.php');
include_once('controller/RegistroController.php');


include_once('third-party/mustache/src/Mustache/Autoloader.php');


class Configuration {
    private $configFile = 'config/config.ini';

    public function __construct() {
    }

    public function getUserController() {
        return new UserController(
            new UserModel($this->getDatabase()),
            $this->getRenderer());
    }
    public function getHomeController() {
        return new HomeController(
            new HomeModel($this->getDatabase()),
            $this->getRenderer());
    }
    public function getRegistroController() {
        return new RegistroController(
            new RegistroModel($this->getDatabase()),
            $this->getRenderer());
    }

    private function getArrayConfig() {
        return parse_ini_file($this->configFile);
    }

    private function getRenderer() {
        return new MustacheRender('view/partial');
    }

    public function getDatabase() {
        $config = $this->getArrayConfig();
        return new MySqlDatabase(
            $config['servername'],
            $config['username'],
            $config['password'],
            $config['database']);
    }

    public function getRouter() {
        return new Router(
            $this,
            "getHomeController",
            "home");
    }
}