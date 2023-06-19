<?php
/*
class AdminService
{
session_start();

// Verificar si ya existe una fecha de inicio de sesión en la sesión
if (isset($_SESSION['last_login']))
{
$lastLogin = $_SESSION['last_login'];
echo "Última fecha de inicio de sesión: " . $lastLogin;
}

// Guardar la fecha actual como la última fecha de inicio de sesión
$_SESSION['last_login'] = date("Y-m-d H:i:s");
session_start();
// Obtener la última fecha de inicio de sesión
$lastUserId = $_SESSION['last_user_id'];
$lastLogin = $_SESSION['last_login'];
// Consulta para contar la cantidad de usuarios creados desde la última fecha de inicio de sesión
$sql = "SELECT COUNT(*) AS usuarios_nuevos FROM usuario WHERE id > '$lastUserId'";
echo "Usuarios nuevos desde el último usuario registrado: " . $result['usuarios_nuevos'];


// Función para obtener el total de usuarios
function getTotalUsuarios()
{
    $query = "SELECT COUNT(*) AS total_usuarios FROM usuario";
    $result = $this->database->query($query);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    return $row['total_usuarios'];
}

// Función para obtener el total de partidas
function getTotalPartidas()
{
    $query = "SELECT COUNT(*) AS total_partidas FROM partida";
    $result = $this->database->query($query);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    return $row['total_partidas'];
}

// Función para obtener el total de preguntas
function getTotalPreguntas()
{
    $query = "SELECT COUNT(*) AS total_preguntas FROM pregunta";
    $result = $this->database->query($query);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    return $row['total_preguntas'];
}


SELECT COUNT(*) as total_preguntas_creadas FROM pregunta; (???????????????????);


function getTotalPreguntasCorrectasPorUsuario()
{
    $query = "SELECT u.id_usuario, u.Nombre_usuario,
        COUNT(up.id_pregunta) AS total_preguntas,
        COUNT(up.id_pregunta) / (SELECT COUNT(*) FROM pregunta) AS porcentaje_correctas
        FROM usuario AS u
        LEFT JOIN usuario_pregunta AS up ON u.id_usuario = up.id_usuario
        WHERE up.respuesta_correcta = 1
        GROUP BY u.id_usuario, u.Nombre_usuario";

    // Ejecutar la consulta y obtener el resultado

    // ...

    return $result;
}

function getCantidadUsuariosPorPais()
{
    $query = "SELECT p.Nombre_pais, COUNT(u.id_usuario) AS cantidad_usuarios
        FROM usuario AS u
        JOIN pais AS p ON u.idPais = p.id_pais
        GROUP BY p.Nombre_pais";

    // Ejecutar la consulta y obtener el resultado

    // ...

    return $result;
}


function getCantidadUsuariosPorGenero()
{
    $query = "SELECT Genero, COUNT(*) AS cantidad_usuarios
        FROM usuario
        GROUP BY Genero";

    // Ejecutar la consulta y obtener el resultado

    // ...

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

    // Ejecutar la consulta y obtener el resultado

    // ...

    return $result;
}

/*
Para permitir que los gráficos y tablas de datos se filtren por día, semana, mes o año, y que se puedan imprimir,
puedes agregar opciones de filtro en tu interfaz de usuario
y ajustar las consultas SQL en función de los filtros seleccionados.
Aquí hay una idea de cómo puedes hacerlo:

Agrega opciones de filtro en tu interfaz de usuario: Puedes utilizar elementos como botones, selectores de fechas
o menús desplegables para permitir al usuario seleccionar el período de tiempo deseado (día, semana, mes o año).

Captura la selección del filtro en tu aplicación: Utiliza JavaScript para capturar la opción seleccionada por el usuario.

Actualiza las consultas SQL con base en el filtro seleccionado:
Ajusta las consultas SQL para filtrar los datos según el período de tiempo seleccionado.
Puedes utilizar cláusulas WHERE y funciones de fecha y tiempo en tus consultas para filtrar los datos correctamente.

Ejecuta las consultas SQL y obtén los resultados filtrados:
Utiliza PHP para ejecutar las consultas SQL actualizadas y obtener los resultados filtrados.

Muestra los resultados filtrados en la interfaz de usuario:
Utiliza HTML y CSS para mostrar los gráficos y tablas de datos con los resultados filtrados.

Agrega la funcionalidad de impresión: Puedes utilizar CSS para aplicar estilos de impresión
y agregar un botón de impresión en tu interfaz de usuario. Al hacer clic en el botón de impresión,
puedes abrir una ventana de impresión del navegador con los elementos deseados
(gráficos, tablas de datos) listos para imprimir.
 */
