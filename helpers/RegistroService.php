<?php

class RegistroService
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
        if (!$this->validatePassword($model, $pass, $passValidate)) {
            $this->renderRegistrationError($renderer, $data, "Las contraseñas no coinciden. Intentá nuevamente.");
        } else {
            if (!$this->createAccount($model, $pass, $nameComplete, $birth, $sex, $country, $lat, $lng, $mail, $nameUser, $photo)) {
                $this->renderRegistrationError($renderer, $data, "El usuario ya está registrado. Prueba con otro nombre o un correo electrónico diferente.");
            } else {
                $this->renderRegistrationSuccess($renderer, $data);
            }
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

    private function validatePassword($model, $pass, $passValidate)
    {
        return $model->validatePassword($pass, $passValidate);
    }

    private function renderRegistrationSuccess($renderer, $data)
    {
        $renderer->render("registroExitoso", $data);
    }

    private function renderRegistrationError($renderer, $data, $message)
    {
        $data["message"] = $message;
        $data['showMessage'] = true;
        $renderer->render("registro", $data);
    }
}