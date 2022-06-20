<?php

namespace Database;

use PDO;
use PDOException;
use Database\Constants;


require '/srv/www/apache/vendor/autoload.php';


interface DBConnInterface
{
    public function connect();
}





class SQLConnection implements DBConnInterface
{
    protected $dbName = Constants::DBNAME;
    protected PDO $pdo;

    public function connect()
    {
        $db = $this->dbName;
        $dbc = 'mysql:host=localhost;$dbname=' . $db . ';charset=UTF8';

        try {
            $pdo = new PDO($dbc, '', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
            return $pdo;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
