<?php

namespace Model;

use PDO;
use Database\DBConnInterface;
use Values\MetaParser;
use Database\Constants;
use Values\DiffTime;

class CategoryTags
{
    protected $dbName = Constants::DBNAME;
    protected $dbConnInterface;

    public function __construct(DBConnInterface $dbConnInterface)
    {
        $this->dbConnInterface = $dbConnInterface;
    }



    public function selectCategoryTags(array $params)
    {
        $db = $this->dbName;
        $lang = $params["lang"];


        $categoryID = $params['category'];

        $tagsID = $_GET['tags'];

        $tagsIDCount = preg_match_all('!\d+!', $tagsID);

        $sql = "SELECT " . $db . ".meals_names.meals_id AS id, " . $db
            . ".meals_names.title, " . $db . ".meals_names.description, " . $db
            . ".meals_names.status
             FROM " . $db . ".meals_names
             INNER JOIN " . $db . ".meals_tags
             ON meals_tags.meals_id = meals_names.meals_id
             INNER JOIN " . $db . ".meals
             ON meals.id = meals_names.meals_id
             WHERE meals_names.locale='" . $lang . "'
             AND meals_tags.tags_id IN (" . $tagsID . ")
             AND meals.category_id " . $categoryID;
        if (!DiffTime::validDiffTime()) {
            $sql .= " AND status ='created' ";
        }

        $sql .= " GROUP BY meals_names.meals_id, meals_names.title,
              meals_names.description, meals_names.status
              HAVING COUNT(meals_tags.meals_id) = " . $tagsIDCount;


        if (isset($_GET['per_page'])) {
            $sql .= " LIMIT " . MetaParser::showRows() . "," . MetaParser::getPerPage();
        }


        $pdo = $this->dbConnInterface->connect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $row;
    }

    public function categoryTagsRowCount()
    {
        $db = $this->dbName;
        $lang = $_GET["lang"];
        $categoryID = "= " . $_GET['category'];


        if ($categoryID == "null") {
            $categoryID = "IS NULL";
        }

        if ($categoryID == "!null") {
            $categoryID = "IS NOT NULL";
        }


        $tagsID = $_GET['tags'];

        $tagsIDCount = preg_match_all('!\d+!', $tagsID);

        $sql = "SELECT " . $db . ".meals_names.meals_id AS id, " . $db
            . ".meals_names.title, " . $db . ".meals_names.description, " . $db
            . ".meals_names.status
              FROM " . $db . ".meals_names
              INNER JOIN " . $db . ".meals_tags
              ON meals_tags.meals_id = meals_names.meals_id
              INNER JOIN " . $db . ".meals
              ON meals.id = meals_names.meals_id
              WHERE meals_names.locale='" . $lang . "'
              AND meals_tags.tags_id IN (" . $tagsID . ")
              AND meals.category_id  " . $categoryID
            . " GROUP BY meals_names.meals_id, meals_names.title,
              meals_names.description, meals_names.status
              HAVING COUNT(meals_tags.meals_id) = " . $tagsIDCount;


        if (!DiffTime::validDiffTime()) {
            $sql .= " AND status ='created'";
        }



        $pdo = $this->dbConnInterface->connect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $row = $stmt->rowCount();


        return $row;
    }
}
