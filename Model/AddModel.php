<?php

class AddModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function addQuestion($idRol, $idCategoria, $descripcion, $opcionA, $opcionB, $opcionC, $opcionD, $resp_correcta)
    {
        $idEstado = 0;
        if ( $idRol == 3){
            $idEstado = 1;
        }
        if ($idRol ==2){
            $idEstado = 2;
        }
        $query = "INSERT INTO pregunta (id_estado, id_categoria, descripcion, opcionA, opcionB, opcionC, opcionD, resp_correcta)
              VALUES ($idEstado, $idCategoria, '$descripcion', '$opcionA', '$opcionB', '$opcionC', '$opcionD', '$resp_correcta')";

        $this->database->update($query);

        if ($this->database->singleQuery("SELECT * FROM pregunta WHERE id_categoria = $idCategoria AND descripcion = '$descripcion'") === null) {
            echo "Error: No se pudo insertar la pregunta en la base de datos.";
        }
    }

}