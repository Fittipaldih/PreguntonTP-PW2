<?php
include_once('helpers/MySqlDatabase.php');
include_once("helpers/MustacheRender.php");
include_once('helpers/Router.php');
include_once('helpers/SessionManager.php');
include_once('helpers/RegistroService.php');
include_once('helpers/UserService.php');

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
include_once('controller/addQuestionController.php');
include_once('controller/EditQuestionController.php');

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
            $this->getRegistroModel(),
            $this->getRenderer(),
        $this->getRegistroService());
    }
    public function getHomeController()
    {
        return new HomeController(
            new HomeModel($this->getDatabase()),
            $this->getRenderer(),
            $this->getSessionManager());
    }
    public function getAddQuestionController(){
        return new addQuestionController(
            $this->getQuestionModel(),
            $this->getRenderer(),
            $this->getSessionManager());
    }
    public function getEditQuestionController(){
        return new EditQuestionController(
            $this->getQuestionModel(),
            $this->getRenderer(),
            $this->getSessionManager());
    }
    public function getLobbyController()
    {
        return new LobbyController(
            new LobbyModel($this->getDatabase()),
            $this->getRenderer(),
            $this->getSessionManager(),
            $this->getUserService());
    }
    public function getUserController()
    {
        return new UserController(
            $this->getUserModel(),
            $this->getRenderer(),
            $this->getSessionManager(),
        $this->getUserService());
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
            $this->getSessionManager(),
        $this->getUserService(),

        );
    }
    public function getQuestionController()
    {
        return new QuestionController(
            $this->getQuestionModel(),
            $this->getRenderer(),
            $this->getSessionManager());
    }
    public function getUserService()
    {
        return new UserService(
            $this->getUserModel()
        );
    }
    public function getRegistroService(){
        return new RegistroService(
            $this->getRegistroModel()
        );
    }
    public function getQuestionModel()
    {
        return new QuestionModel($this->getDatabase());
    }
    public function getRegistroModel()
    {
        return new RegistroModel($this->getDatabase());
    }
    public function getUserModel(){
        return new UserModel($this->getDatabase());
    }
    public function getSessionManager()
    {
        return new SessionManager();
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

}