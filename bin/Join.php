<?php

namespace Upload;

use Database\DBConnInterface;
use Database\SQLConnection;
use Values\MealsColumns;

require_once "../config/SQLConnection.php";
require_once "../config/config.php";
require_once "./GenerateSQL.php";

class Join
{
    protected $generateSQL;
    protected $dbConnection;

    public function __construct(
        GenerateSQL $generateSQL,
        DBConnInterface $dbConnection
    ) {
        $this->generateSQL = $generateSQL;
        $this->dbConnection = $dbConnection;
    }

    public function joinTags(array $argument)
    {
        $tableValues = [
            "table"  => "meals_tags",
            "column" => MealsColumns::$mealsColumns["meals_tags"],
        ];

        $params = [
            "meals_id" => $argument[2],
            "tags_id" => $argument[3],
        ];

        $pdo = $this->dbConnection->connect();

        $sql = $this->generateSQL->insert($tableValues);

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue($tableValues["column"][0], $params["meals_id"]);
        $stmt->bindValue($tableValues["column"][1], $params["tags_id"]);
        $stmt->execute();
    }

    public function joinIngredients(array $argument)
    {
        $tableValues = [
            "table"  => "meals_ingredients",
            "column" => MealsColumns::$mealsColumns["meals_ingredients"],
        ];

        $params = [
            "meals_id" => $argument[2],
            "ingredients_id" => $argument[3],
        ];

        $pdo = $this->dbConnection->connect();

        $sql = $this->generateSQL->insert($tableValues);

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue($tableValues["column"][0], $params["meals_id"]);
        $stmt->bindValue($tableValues["column"][1], $params["ingredients_id"]);
        $stmt->execute();
    }
}

$conn = new SQLConnection();

$upload = new GenerateSQL($conn);


$join = new Join($upload, $conn);


if ($argv[1] == "tags") {
    $join->joinTags($argv);
}

if ($argv[1] == "ingredients") {
    $join->joinIngredients($argv);
}
