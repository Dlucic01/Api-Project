<?php

namespace Model;

use Database\Constants;
use PDO;
use Database\DBConnInterface;
use Validators\ValidUrl;
use Values\DiffTime;
use Values\MetaParser;

class MealsData
{
    protected $dbName = Constants::DBNAME;
    protected $dbConnInterface;


    public function __construct(DBConnInterface $dbConnInterface)
    {
        $this->dbConnInterface = $dbConnInterface;
    }


    public function returnMealsData(array $params)
    {
        $db = $this->dbName;


        $lang = $params['lang'];
        $diffTime = DiffTime::validDiffTime();
        $table = $db . $params['table'];

        #        echo "test";

        $sql = "SELECT meals_id AS id, title, description, status FROM "
            . $table . " WHERE locale=" . $lang;


        if (!DiffTime::validDiffTime()) {
            $sql .= " AND status ='created'";
        }


        #  echo $diffTime;

        if (DiffTime::validDiffTime()) {
            $sql .= " AND created_at between " . "'" . $diffTime . "'" . " AND NOW()"
                . " OR locale= " . $lang . " AND updated_at between " . "'"
                . $diffTime . "'" . " AND NOW()"
                . " OR locale= " . $lang . " AND deleted_at between " . "'"
                . $diffTime . "'" . " AND NOW()";
        }


        if (isset($_GET['per_page'])) {
            $sql .= " LIMIT " . MetaParser::showRows() . "," . MetaParser::getPerPage();
        }


        # echo $sql;


        $pdo = $this->dbConnInterface->connect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }

    public function mealsRowCount()
    {
        $db = $this->dbName;
        $lang = '"' . ValidUrl::validate($_GET['lang']) . '"';
        $diffTime = DiffTime::validDiffTime();

        $sql = "SELECT title FROM " . $db . ".meals_names
                WHERE locale =" . $lang;

        if (!DiffTime::validDiffTime()) {
            $sql .= " AND status ='created'";
        }

        if (DiffTime::validDiffTime()) {
            $sql .= " AND created_at between " . "'" . $diffTime . "'" . " AND NOW()"
                . " OR locale= " . $lang . " AND updated_at between " . "'"
                . $diffTime . "'" . " AND NOW()"
                . " OR locale= " . $lang . " AND deleted_at between " . "'"
                . $diffTime . "'" . " AND NOW()";
        }

        $pdo = $this->dbConnInterface->connect();
        $stmt = $pdo->prepare($sql);

        $stmt->execute();
        $row = $stmt->rowCount();
        return $row;
    }
}
