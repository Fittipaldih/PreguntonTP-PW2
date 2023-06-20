<?php
include_once('helpers/MySqlDatabase.php');
include_once("helpers/MustacheRender.php");
include_once('helpers/Router.php');
include_once('helpers/SessionManager.php');

include_once('helpers/RegistroService.php');
include_once('helpers/QrUserService.php');

include_once("model/UserModel.php");
include_once("model/HomeModel.php");
include_once("model/RegistroModel.php");
include_once("model/LobbyModel.php");
include_once("model/RankingModel.php");
include_once("model/PartidaModel.php");
include_once('model/QuestionModel.php');

include_once('controller/UserController.php');
include_once('controller/HomeController.php');
include_once('controller/RegistroController.php');
include_once('controller/LobbyController.php');
include_once('controller/RankingController.php');
include_once('controller/PartidaController.php');
include_once('controller/QuestionController.php');

include_once('third-party/mustache/src/Mustache/Autoloader.php');
include_once('third-party/phpqrcode/qrlib.php');

class Configuration
{
    private $configFile = 'config/config.ini';

    public function __construct()
    {
    }
    public function getRegistroController()
    {
        return new RegistroController(
            new RegistroModel($this->getDatabase()),
            $this->getRenderer());
    }
    public function getHomeController()
    {
        return new HomeController(
            new HomeModel($this->getDatabase()),
            $this->getRenderer(),
            $this->getSessionManager());
    }
    public function getLobbyController()
    {
        return new LobbyController(
            new LobbyModel($this->getDatabase()),
            $this->getRenderer(),
            $this->getSessionManager());
    }
    public function getUserController()
    {
        return new UserController(
            new UserModel($this->getDatabase()),
            $this->getRenderer(),
            $this->getSessionManager());
    }
    public function getRankingController()
    {
        return new RankingController(
            new RankingModel($this->getDatabase()),
            $this->getRenderer(),
            $this->getSessionManager());
    }
    public function getPartidaController()
    {
        return new PartidaController(
            new PartidaModel($this->getDatabase()),
            $this->getRenderer(),
            $this->getSessionManager());
    }

    public function getQuestionController()
    {
        return new QuestionController(
            new QuestionModel($this->getDatabase()),
            $this->getRenderer(),
            $this->getSessionManager());
    }
    private function getArrayConfig()
    {
        return parse_ini_file($this->configFile);
    }
    private function getRenderer()
    {
        return new MustacheRender('view/partial');
    }
    public function getDatabase()
    {
        $config = $this->getArrayConfig();
        return new MySqlDatabase(
            $config['servername'],
            $config['username'],
            $config['password'],
            $config['database']);
    }
    public function getRouter()
    {
        return new Router(
            $this,
            "getHomeController",
            "home");
    }
    public function getSessionManager()
    {
        return new SessionManager();
    }
}