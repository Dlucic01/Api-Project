<?php

namespace Upload;

use Database\DBConnInterface;
use Database\SQLConnection;

require_once "../config/SQLConnection.php";
require_once "../config/config.php";



class UpdateMeals
{
    protected $dbConnection;

    public function __construct(DBConnInterface $dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }



    public function updateCategory(array $arguments)
    {
        $pdo = $this->dbConnection->connect();

        // UPDATE meals SET category_id = 71 WHERE id = 8

        $sql = "UPDATE jela_svijeta.meals SET category_id =" . $arguments[3]
            . " WHERE id=" . $arguments[2];

        $stmt = $pdo->prepare($sql);

        $stmt->execute();

        $pdo = null;
    }

    public function updateStatus(array $arguments)
    {
        // Create Modified Deleted

        if ($arguments[2] == 0) {
            $status = '"created"';
        }

        if ($arguments[2] == 1) {
            $status = '"modified"';
            $timestamp = 'updated_at';
        }

        if ($arguments[2] == 2) {
            $status = '"deleted"';
            $timestamp = 'deleted_at';
        }

        $pdo = $this->dbConnection->connect();

        $sql = "UPDATE jela_svijeta.meals_names SET status=" . $status
            . " WHERE meals_id=" . $arguments[3];
        echo $sql;
        $stmt = $pdo->prepare($sql);

        $stmt->execute();


        $pdo = null;


        $pdo = $this->dbConnection->connect();

        $sql = "UPDATE jela_svijeta.meals_names SET " . $timestamp
            . "=NOW()  WHERE meals_id=" . $arguments[3];
        echo "\n\n\n" . $sql;
        $stmt = $pdo->prepare($sql);

        $stmt->execute();


        $pdo = null;
    }
}

print_r($argv);
$conn = new SQLConnection();
$update = new UpdateMeals($conn);



if ($argv[1] == "category") {
    $update->updateCategory($argv);
}

if ($argv[1] == "status") {
    $update->updateStatus($argv);
}
