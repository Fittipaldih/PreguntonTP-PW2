<?php

class AdminModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }
    public function getTotalPlayers($finit, $fend)
    {
        $query = "SELECT COUNT(*) AS total_usuarios FROM usuario WHERE Id_rol = 3";

        if ($finit != null && $fend != null) {
            $query .= " AND Fecha_registro >= '$finit' AND Fecha_registro <= '$fend' ";
        }

        $result = $this->database->singleQuery($query);
        return $result['total_usuarios'];
    }

    public function getAllPlayers($finit, $fend)
    {
        $query= "SELECT * FROM usuario WHERE Id_rol = 3";

        if ($finit != null && $fend != null) {
            $query .= " AND Fecha_registro >= '$finit' AND Fecha_registro <= '$fend' ";
        }
        $result = $this->database->query($query);
        return $result;
    }

    public function getPrintPlayer($finit, $fend)
    {
        $query= "SELECT * FROM usuario WHERE Id_rol = 3";

        if ($finit != null && $fend != null) {
            $query .= " AND Fecha_registro >= '$finit' AND Fecha_registro <= '$fend' ";
        }
        $result = $this->database->print($query);
        return $result;
    }

    public function getTotalUsersFromCountry($finit, $fend)
    {
        $query = "SELECT p.nombre AS Pais, COUNT(u.Id) AS cantidad_usuarios
              FROM usuario AS u
              JOIN pais AS p ON u.idPais = p.id WHERE Id_rol =3
               ";

        if ($finit != null && $fend != null) {
            $query .= "AND u.Fecha_registro >= '$finit' AND u.Fecha_registro <= '$fend' ";
        }
        $query .= " GROUP BY p.nombre";
        $result = $this->database->query($query);

        $data = array();
        foreach ($result as $row) {
            $nombrePais = $row['Pais'];
            $cantidadUsuarios = $row['cantidad_usuarios'];
            $data[] = array('Pais' => $nombrePais, 'cantidadUsuarios' => $cantidadUsuarios);
        }

        return $data;
    }
    public function getTotalUsersByGenre($finit, $fend)
    {
        $query = "SELECT Genero, COUNT(*) AS cantidad_usuarios
              FROM usuario WHERE Id_rol =3
               ";

        if ($finit !=null && $fend !=null) {
            $query .= "AND Fecha_registro >= '$finit' AND Fecha_registro <= '$fend' ";
        }

        $query .= " GROUP BY Genero";

        return $this->database->query($query);
    }
    public function getTotalUsersByAge($finit, $fend)
    {
        $query = "SELECT
                CASE
                    WHEN TIMESTAMPDIFF(YEAR, Fecha_nacimiento, CURDATE()) < 18 THEN 'Menor (-18)'
                    WHEN TIMESTAMPDIFF(YEAR, Fecha_nacimiento, CURDATE()) BETWEEN 18 AND 64 THEN 'Adulto (18 a 64)'
                    WHEN TIMESTAMPDIFF(YEAR, Fecha_nacimiento, CURDATE()) >= 65 THEN 'Jubilado (+65)'
                END AS grupo_edad,
                COUNT(*) AS cantidad_usuarios
              FROM usuario WHERE Id_rol =3 
               ";

        if ($finit !=null && $fend !=null) {
            $query .= "AND Fecha_registro >= '$finit' AND Fecha_registro <= '$fend' ";
        }

        $query .= " GROUP BY grupo_edad";

        return $this->database->query($query);
    }
    public function getTotalUsersNews(){
        $rt = $this->database->singleQuery("SELECT COUNT(*) AS total_usuarios FROM usuario WHERE Id_rol = 3 AND Fecha_registro >= DATE_SUB(CURDATE(), INTERVAL 3 DAY)");
        return $rt['total_usuarios'];
    }
    public function getTotalGames($finit, $fend)
    {
        $query= "SELECT COUNT(p.id) AS total_partidas FROM partida p";
        if ($finit != null && $fend != null) {
            $query .= " WHERE p.fecha >= '$finit' AND p.fecha <= '$fend' ";
        }
        $rt = $this->database->singleQuery($query);
        return $rt['total_partidas'];
    }

    public function getPartialGames($finit, $fend, $registrosPorPagina, $offset)
    {
        $query = "SELECT * FROM partida";

        if ($finit != null && $fend != null) {
            $query .= " WHERE fecha >= '$finit' AND fecha <= '$fend'";
        }

        $query .= " LIMIT $registrosPorPagina OFFSET $offset";

        return $this->database->query($query);
    }

    public function getAllGames($finit, $fend)
    {
        $query = "SELECT DISTINCT * FROM partida";

        if ($finit != null && $fend != null) {
            $query .= " WHERE fecha >= '$finit' AND fecha <= '$fend'";
        }

        return $this->database->print($query);
    }

   public function getAllQuestions($finit, $fend)
    {
        $query="SELECT * FROM pregunta p";
        if ($finit != null && $fend != null) {
            $query .= " WHERE p.fecha_creacion >= '$finit' AND p.fecha_creacion <= '$fend'";
        }
        return $this->database->query($query);
    }

    public function getTotalQuestions($finit, $fend)
    {
        $query = "SELECT COUNT(*) AS total_preguntas FROM pregunta p";
        if ($finit != null && $fend != null) {
            $query .= " WHERE p.fecha_creacion >= '$finit' AND p.fecha_creacion <= '$fend'";
        }
        $rt = $this->database->singleQuery($query);
        return $rt['total_preguntas'];
    }
}
