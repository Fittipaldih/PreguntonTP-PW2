<?php

class AdminModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }
    public function getTotalPlayers()
    {
        $rt = $this->database->singleQuery("SELECT COUNT(*) AS total_usuarios FROM usuario WHERE Id_rol = 3");
        return $rt['total_usuarios'];
    }
    public function getAllPlayers()
    {
        return $this->database->query("SELECT * FROM usuario WHERE Id_rol = 3");
    }
    public function getTotalUsersFromCountry()
    {
        $query = "SELECT p.nombre AS Pais, COUNT(u.Id) AS cantidad_usuarios
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
    public function getTotalUsersByGenre(){
        return $this->database->query("SELECT Genero, COUNT(*) AS cantidad_usuarios
        FROM usuario
        GROUP BY Genero");
    }
    public function getTotalUsersByAge(){
        return $this->database->query("SELECT
        CASE
        WHEN TIMESTAMPDIFF(YEAR, Fecha_nacimiento, CURDATE()) < 18 THEN 'Menor (-18)'
        WHEN TIMESTAMPDIFF(YEAR, Fecha_nacimiento, CURDATE()) BETWEEN 18 AND 64 THEN 'Adulto (18 a 64)'
        WHEN TIMESTAMPDIFF(YEAR, Fecha_nacimiento, CURDATE()) >= 65 THEN 'Jubilado (+65)'
        END AS grupo_edad,
        COUNT(*) AS cantidad_usuarios
        FROM usuario
        GROUP BY grupo_edad");
    }
    public function getTotalUsersNews(){
        $rt = $this->database->singleQuery("SELECT COUNT(*) AS total_usuarios FROM usuario WHERE Id_rol = 3 AND Fecha_registro >= DATE_SUB(CURDATE(), INTERVAL 3 DAY)");
        return $rt['total_usuarios'];

    }
    public function getTotalGames()
    {
        $rt = $this->database->singleQuery("SELECT COUNT(*) AS total_partidas FROM partida");
        return $rt['total_partidas'];
    }
    public function getAllGames()
    {
        return $this->database->query("SELECT * FROM partida");
    }
    public function getTotalQuestions()
    {
        $rt = $this->database->singleQuery("SELECT COUNT(*) AS total_preguntas FROM pregunta");
        return $rt['total_preguntas'];
    }
    public function getAllQuestions()
    {
        return $this->database->query("SELECT * FROM pregunta");
    }

    /*

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