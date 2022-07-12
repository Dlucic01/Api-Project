<?php

namespace Database;

use PDO;
use PDOException;
use Database\Constants;


require __DIR__ . '../../vendor/autoload.php';


interface DBConnInterface
{
    public function connect();
}





class SQLConnection implements DBConnInterface
{
    protected $dbName = Constants::DBNAME;
    protected $dbUser = Constants::DBUSER;
    protected $dbPass = Constants::DBPASS;
    protected PDO $pdo;

    public function connect()
    {
        $db = $this->dbName;
	$user = $this->dbUser;
	$pass = $this->dbPass;

        $dbc = 'mysql:host=localhost;$dbname=' . $db . ';charset=UTF8';

        try {
            $pdo = new PDO($dbc, $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
            return $pdo;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
