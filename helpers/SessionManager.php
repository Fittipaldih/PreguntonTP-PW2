<?php

class SessionManager
{
    public function __construct()
    {
        $this->startSession();
    }

    private function startSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /* Al tener this start session en todos los metodos, se llama explicitamente */
    public function set($key, $value)
    {
        $this->startSession();
        $_SESSION[$key] = $value;
    }

    public function get($key)
    {
        $this->startSession();
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return null;
    }

    public function delete($key)
    {
        $this->startSession();
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    public function destroy()
    {
        $this->startSession();
        session_unset();
        session_destroy();
    }

}