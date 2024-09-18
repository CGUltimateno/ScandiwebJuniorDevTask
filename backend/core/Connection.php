<?php

namespace app\core;

use \PDO;

abstract class Connection
{
    private $host = 'localhost';
    private $user = 'root';
    private $pass = '12345';
    private $db = 'juniortest';
    protected static $pdo;


    private function connect()
    {
        {
            self::$pdo = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db . ';charset=utf8', $this->user, $this->pass);
            self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
    }

    protected function get()
    {
        if (self::$pdo === null) {
            self::connect();
        }
        return self::$pdo;
    }
}