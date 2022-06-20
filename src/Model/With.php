<?php

namespace Model;

use PDO;
use Database\DBConnInterface;
use Database\Constants;

class With
{
    protected $dbName = Constants::DBNAME;
    protected $dbConnInterface;

    public function __construct(DBConnInterface $dbConnInterface)
    {
        $this->dbConnInterface = $dbConnInterface;
    }


    public function selectWith(array $params)
    {
        $db = $this->dbName . ".";
        $lang = '"' . $params['lang'] . '"';
        $valueCTI = $params['cti'];
        $mealsTable = "meals_" . $valueCTI;

        $id = $params['id'];

        if ($valueCTI == "category") {
            $mealsTable = "meals";
        }

        $sql = "SELECT " . $db .  $valueCTI . "_names." . $valueCTI . "_id AS id, "
            . $db . $valueCTI . "_names.title," . $db . $valueCTI . "_names.slug
             FROM " . $db . $valueCTI . "_names
             INNER JOIN " . $db . $mealsTable
            . " ON " . $mealsTable . "." . $valueCTI . "_id =" . $valueCTI
            . "_names." . $valueCTI . "_id";

        if ($mealsTable == "meals") {
            $sql .=  " WHERE " . $valueCTI . "_names.locale=" . $lang . "  AND "
                . $mealsTable . ".id = " . $id;
        } else {
            $sql .= " WHERE " . $valueCTI . "_names.locale=" . $lang . "  AND "
                . $mealsTable . ".meals_id = " . $id;
        }


        $pdo = $this->dbConnInterface->connect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $row;
    }
}
