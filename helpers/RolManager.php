<?php

class RolManager
{
    private $rolFile = 'config/rol.ini';
    private function getArrayConfig()
    {
        return parse_ini_file($this->rolFile, true);

    }
    public function getAccessRol($idRol, $module, $method)
    {
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
