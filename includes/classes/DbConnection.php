<?php

class DbConnection
{
    protected $_pdo;

    public function __construct()
    {
        include __DIR__ . '/../../config.php';

        $this->_pdo = new PDO($dns, $user, $password);

        $this->_pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}