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
        $diff_time = $params['diff_time'];
        $table = $db . $params['table'];

        #        echo "test";

        $sql = "SELECT meals_id AS id, title, description, status FROM " .
            $table . " WHERE locale=" . $lang;

        if (!DiffTime::validDiffTime()) {
            $sql .= " AND status ='created'";
        }


        if (!isset($_GET['diff_time'])) {
            $sql .= " AND status='created'";
        }

        if (isset($_GET['diff_time'])) {
            $sql .= " AND DATE(created_at) > " . $diff_time;
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

        $sql = "SELECT title FROM " . $db . ".meals_names
                WHERE status='created' AND locale =" . $lang;

        $pdo = $this->dbConnInterface->connect();
        $stmt = $pdo->prepare($sql);

        $stmt->execute();
        $row = $stmt->rowCount();
        return $row;
    }
}
