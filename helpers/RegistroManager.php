<?php

class RegistroManager
{
    public function receiveRegistrationForm($formData, $model, $renderer)
    {
        $data = [];

        $nameComplete = $formData["nombre"];
        $birth = $formData["fecha_nacimiento"];
        $sex = $formData["sexo"];
        $country = $formData["pais"];
        $lat = $formData["lat"];
        $lng = $formData["lng"];
        $mail = $formData["correo"];
        $nameUser = $formData["nombre_usuario"];
        $pass = $formData["contrasenia"];
        $passValidate = $formData["confirmar_contrasenia"];
        $photo = null;
        if ($formData['foto_perfil']['name']) {
            $photo = basename($formData['foto_perfil']['name']);
            $imagePath = "./public/imagenes/" . $photo;
            move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $imagePath);
        }
        if ($model->validatePassword($pass, $passValidate)) {

            if ($this->createAccount($model, $pass, $nameComplete, $birth, $sex, $country, $lat, $lng, $mail, $nameUser, $photo)) {

                $renderer->render("registroExitoso", $data);
            } else {
                $data["message"] = "El usuario ya está registrado. Prueba con otro nombre o un correo electrónico diferente.";
                $data['showMessage'] = true;
                $renderer->render("registro", $data);
            }

        } else {
            $data["message"] = "las contraseñas no coinciden. Intentá nuevamente. ";
            $data['showMessage'] = true;
            $renderer->render("registro", $data);
        }
    }

    private function createAccount($model, $pass, $nameComplete, $birth, $sex, $country, $lat, $lng, $mail, $nameUser, $photo): bool
    {
        {
            if ($model->saveUser($nameComplete, $birth, $sex, $country, $lat, $lng, $mail, $nameUser, $photo, $pass)) {
                $hash = $model->getHash($mail);
                $model->sendValidateEmail($mail, $hash, $nameComplete);
                return true;
            }
        }
        return false;
    }
}