<?php

namespace Model;

use Database\DBConnInterface;
use PDO;
use Values\DiffTime;
use Values\MetaParser;
use Database\Constants;

class Tags
{
    protected $dbName = Constants::DBNAME;

    protected $dbConnInterface;


    public function __construct(DBConnInterface $dbConnInterface)
    {
        $this->dbConnInterface = $dbConnInterface;
    }


    /**
     *@method returnTMeals returns all meals with int $params['tags']
     **/
    public function returnTMeals(array $params)
    {
        $db = $this->dbName;

        $lang = $params["lang"];
        $id = $_GET['tags'];
        $idCount = preg_match_all('!\d+!', $id);



        $sql = "SELECT " . $db . ".meals_names.meals_id AS id, " . $db
            . ".meals_names.title, " . $db . ".meals_names.description, "
            . $db . ".meals_names.status
              FROM " . $db . ".meals_names
              INNER JOIN " . $db . ".meals_tags
              ON meals_tags.meals_id = meals_names.meals_id
              WHERE " . $db . ".meals_tags.tags_id
              IN (" . $id . ") AND " . $db . ".meals_names.locale =" . $lang;

        if (!DiffTime::validDiffTime()) {
            $sql .= " AND status ='created'";
        }

        $sql .= " GROUP BY meals_names.meals_id, meals_names.title,
              meals_names.description, meals_names.status
              HAVING COUNT(meals_tags.meals_id) = " . $idCount;


        if (isset($_GET['per_page'])) {
            $sql .= " LIMIT " . MetaParser::showRows() . ","
                . MetaParser::getPerPage();
        }


        $pdo = $this->dbConnInterface->connect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $row;
    }

    public function tagsRowCount()
    {
        $lang = $_GET["lang"];
        $lang = '"' . $lang . '"';
        $id = $_GET['tags'];
        $idCount = preg_match_all('!\d+!', $id);
        $db = $this->dbName;



        $sql = "SELECT " . $db . ".meals_names.meals_id AS id, " . $db
            . ".meals_names.title, " . $db . ".meals_names.description, "
            . $db . ".meals_names.status
              FROM " . $db . ".meals_names
              INNER JOIN " . $db . ".meals_tags
              ON meals_tags.meals_id = meals_names.meals_id
              WHERE " . $db . ".meals_tags.tags_id
              IN (" . $id . ") AND " . $db . ".meals_names.locale =" . $lang;

        if (!DiffTime::validDiffTime()) {
            $sql .= " AND status ='created'";
        }

        $sql .= " GROUP BY meals_names.meals_id, meals_names.title,
              meals_names.description, meals_names.status
              HAVING COUNT(meals_tags.meals_id) = " . $idCount;



        $pdo = $this->dbConnInterface->connect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $row = $stmt->rowCount();


        return $row;
    }
}
