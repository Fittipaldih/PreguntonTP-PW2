<?php

class MySqlDatabase
{
    private $connection;

    public function __construct($serverName, $userName, $password, $databaseName)
    {
        $this->connection = mysqli_connect(
            $serverName,
            $userName,
            $password,
            $databaseName);

        if (!$this->connection) {
            die('Connection failed: ' . mysqli_connect_error());
        }
    }

    public function __destruct()
    {
        mysqli_close($this->connection);
    }

    public function query($sql)
    {
        $result = mysqli_query($this->connection, $sql);
        return mysqli_fetch_all($result, MYSQLI_BOTH);
    }

    public function print($sql)
    {
        $result = mysqli_query($this->connection, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    public function singleQuery($sql)
    {
        $result = mysqli_query($this->connection, $sql);
        return mysqli_fetch_assoc($result);
    }

    public function update($sql)
    {
        $result = mysqli_query($this->connection, $sql);
    }

    public function prepare($sql)
    {
        return mysqli_prepare($this->connection, $sql);
    }
}