<?php

class RolManager
{
    private $rolFile = 'config/rol.ini';
    private function getArrayConfig()
    {
        // Lee y parsea el archivo de configuración de roles (rol.ini) y devuelve un array con la estructura de roles y permisos.
        return parse_ini_file($this->rolFile, true);

    }
    public function getAccessRol($idRol, $module, $method)
    {
        // Verifica si el rol, módulo y método proporcionados existen y están permitidos
        $arrayRol = $this->getArrayConfig();

        if (array_key_exists($idRol, $arrayRol)) {
            $controladoresValidos = $arrayRol[$idRol];
            if (array_key_exists($module, $controladoresValidos)) {
                $metodosValidos = $controladoresValidos[$module];
                if (in_array($method, $metodosValidos)) {
                    return true;
                }
            }
        }
        return false;
    }
}
