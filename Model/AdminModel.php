<?php

class AdminModel
{
    private $database;
    public function __construct($database)
    {
        $this->database = $database;
    }
    public function getUserByName($userName)
    {
        return $this->database->query("SELECT u.*, p.nombre AS nombrep
              FROM usuario u
              JOIN pais p ON u.idPais = p.id
              WHERE u.Nombre_usuario = '$userName'");
    }
    public function getUserPhoto($userName)
    {
        $result = $this->database->query("SELECT Foto_perfil FROM usuario WHERE nombre_usuario = '$userName'");
        if ($result === null || empty($result)) {
            return null;
        }
        return $result[0]['Foto_perfil'];
    }
    public function getUserLevelByName($userName)
    {
        return $this->database->query("SELECT nivel FROM usuario WHERE Nombre_usuario = '$userName'");
    }
    public function getUserGamesByName($username)
    {
        return $this->database->query("SELECT * FROM partida WHERE id_usuario =
                        (SELECT Id FROM usuario WHERE Nombre_usuario = '$username') ORDER BY id DESC LIMIT 50");
    }
    public function getUserMaxScore($idUser)
    {
        return $this->database->query("SELECT MAX(puntaje) FROM partida WHERE id_usuario=$idUser");
    }
    public function getUserMaxScoreByName($username)
    {
        $rt= $this->database->singleQuery("SELECT puntaje_max FROM usuario WHERE Nombre_usuario = '$username'");
        return $rt["puntaje_max"];
    }

    public function updateLevelUserById($idUsuario)
    {
        $this->database->update("UPDATE usuario
                                 SET nivel = (cant_acertadas / cant_respondidas) * 100
                                 WHERE id = $idUsuario;");
    }
    public function updateCorrectAnswer($idUsuario)
    {
        $this->database->update("UPDATE usuario
                                 SET cant_acertadas = cant_acertadas + 1
                                 WHERE id = $idUsuario;");
    }
    public function setNameComplete($username, $new)
    {
        $this->database->update("UPDATE usuario SET Nombre_completo = '$new' WHERE LOWER(Nombre_usuario) = LOWER('$username')");
    }
    public function setBirthDate($username, $new)
    {
        $this->database->update("UPDATE usuario SET Fecha_nacimiento = '$new' WHERE LOWER(Nombre_usuario) = LOWER('$username')");
    }
    public function setSex($username, $new)
    {
        $this->database->update("UPDATE usuario SET Genero = '$new' WHERE LOWER(Nombre_usuario) = LOWER('$username')");
    }
    public function setCountry($username, $new)
    {
        $this->database->update("UPDATE usuario SET idPais = '$new' WHERE LOWER(Nombre_usuario) = LOWER('$username')");
    }
    public function setPhoto($username, $new)
    {
        $this->database->update("UPDATE usuario SET Foto_perfil = '$new' WHERE LOWER(Nombre_usuario) = LOWER('$username')");
    }

    public function getTotalUsers(){
        $rt= $this->database->singleQuery("SELECT COUNT(*) AS total_usuarios FROM usuario");
        return $rt['total_usuarios'];
    }
    public function getTotalPlayers(){
        $rt= $this->database->singleQuery("SELECT COUNT(*) AS total_usuarios FROM usuario");
        return $rt['total_usuarios'];
    }

    public function getAllPlayers(){
        return $this->database->query("SELECT * FROM usuario");
    }
    public function getTotalGames(){
        $rt= $this->database->singleQuery("SELECT COUNT(*) AS total_partidas FROM partida");
        return $rt['total_partidas'];
    }
    public function getAllGames(){
        return $this->database->query("SELECT * FROM partida");
    }

    public function getTotalQuestions(){
        $rt= $this->database->singleQuery("SELECT COUNT(*) AS total_preguntas FROM pregunta");
        return $rt['total_preguntas'];
    }
    public function getAllQuestions(){
        return $this->database->query("SELECT * FROM pregunta");
    }
    public function getTotalQuestionsCreate(){
        $rt= $this->database->singleQuery("SELECT COUNT(*) AS total_preguntas FROM pregunta");
        return $rt['total_preguntas'];
    }

    function getTotalPreguntasCorrectasPorUsuario()
    {
        $query = "SELECT nivel, Nombre_usuario FROM usuario";
        $result = $this->database->query($query);

        $data = array();
        foreach ($result as $row) {
            $nivel = $row['nivel'];
            $nombreUsuario = $row['Nombre_usuario'];
            $data[] = array('nivel' => $nivel, 'Nombre_usuario' => $nombreUsuario);
        }

        return $data;
    }

    public function getTotalUsersFromCountry() {
        $query = "SELECT p.nombre AS Pais , COUNT(u.Id) AS cantidad_usuarios
              FROM usuario AS u
              JOIN pais AS p ON u.idPais = p.id
              GROUP BY p.nombre";
        $result = $this->database->query($query);

        $data = array();
        foreach ($result as $row) {
            $nombrePais = $row['Pais'];
            $cantidadUsuarios = $row['cantidad_usuarios'];
            $data[] = array('Pais' => $nombrePais, 'cantidadUsuarios' => $cantidadUsuarios);
        }

        return $data;
    }


    /*

function getCantidadUsuariosPorGenero()
{
    $query = "SELECT Genero, COUNT(*) AS cantidad_usuarios
        FROM usuario
        GROUP BY Genero";

    return $result;
}

function getCantidadUsuariosPorGrupoEdad()
{
    $query = "SELECT
        CASE
        WHEN TIMESTAMPDIFF(YEAR, Fecha_nacimiento, CURDATE()) < 18 THEN 'Menor a 18 años'
        WHEN TIMESTAMPDIFF(YEAR, Fecha_nacimiento, CURDATE()) BETWEEN 18 AND 64 THEN '18 a 64 años'
        WHEN TIMESTAMPDIFF(YEAR, Fecha_nacimiento, CURDATE()) >= 65 THEN '65 años en adelante'
        END AS grupo_edad,
        COUNT(*) AS cantidad_usuarios
        FROM usuario
        GROUP BY grupo_edad";

    return $result;
}

Agrega opciones de filtro en tu interfaz de usuario: Puedes utilizar elementos como botones, selectores de fechas
o menús desplegables para permitir al usuario seleccionar el período de tiempo deseado (día, semana, mes o año).

Captura la selección del filtro en tu aplicación: Utiliza JavaScript para capturar la opción seleccionada por el usuario.

Actualiza las consultas SQL con base en el filtro seleccionado:
Ajusta las consultas SQL para filtrar los datos según el período de tiempo seleccionado.
Puedes utilizar cláusulas WHERE y funciones de fecha y tiempo en tus consultas para filtrar los datos correctamente.

y agregar un botón de impresión en tu interfaz de usuario
(gráficos, tablas de datos) listos para imprimir.



Verificar si ya existe una fecha de inicio de sesión en la sesión
if (isset($_SESSION['last_login']))
{
$lastLogin = $_SESSION['last_login'];
echo "Última fecha de inicio de sesión: " . $lastLogin;
}

// Guardar la fecha actual como la última fecha de inicio de sesión
$_SESSION['last_login'] = date("Y-m-d H:i:s");
session_start();
Obtener la última fecha de inicio de sesión
$lastUserId = $_SESSION['last_user_id'];
$lastLogin = $_SESSION['last_login'];
Consulta para contar la cantidad de usuarios creados desde la última fecha de inicio de sesión
$sql = "SELECT COUNT(*) AS usuarios_nuevos FROM usuario WHERE id > '$lastUserId'";
echo "Usuarios nuevos desde el último usuario registrado: " . $result['usuarios_nuevos'];

 */

}