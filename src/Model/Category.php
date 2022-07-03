<?php

namespace Model;

use PDO;
use Database\DBConnInterface;
use Values\DiffTime;
use Values\MetaParser;
use Database\Constants;

class Category
{
    protected $dbConnInterface;
    protected $dbName = Constants::DBNAME;

    public function __construct(DBConnInterface $dbConnInterface)
    {
        $this->dbConnInterface = $dbConnInterface;
    }


    public function returnCMeals(array $params)
    {

        # Returns Meals with a category passed as a parameter


        $lang = $params["lang"];
        $id = $params["id"];
        $diffTime = DiffTime::validDiffTime();
        $db = $this->dbName;

        $sqlFilter = $db . ".meals.category_id " . $id . " AND " . $db
            . ".meals_names.locale =" . $lang;



        $sql = "SELECT " . $db . ".meals_names.meals_id AS id, " . $db
            . ".meals_names.title, " . $db . ".meals_names.description, "
            . $db . ".meals_names.status
              FROM " . $db . ".meals_names
              INNER JOIN " . $db . ".meals
              ON meals.id = meals_names.meals_id
              WHERE " . $sqlFilter;

        if (!DiffTime::validDiffTime()) {
            $sql .= " AND status ='created'";
        }

        if (DiffTime::validDiffTime()) {
            $sql .= " AND meals_names.created_at between " . "'" . $diffTime . "'"
                . " AND NOW()"
                . " OR " . $sqlFilter . " AND locale= " . $lang
                . " AND updated_at between " . "'" . $diffTime . "'" . " AND NOW()"
                . " OR  " . $sqlFilter . " AND locale= " . $lang
                . " AND deleted_at between " . "'" . $diffTime . "'" . " AND NOW()";
        }

        #  echo $sql;

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


    /**
     *@method returnCMealsNull returns all meals with category NULL
     **/

    public function returnCMealsNull(array $params)
    {
        $lang = $params["lang"];

        $db = $this->dbName;
        $id = $params["id"];
        $diffTime = DiffTime::validDiffTime();

        $sqlFilter = $db . ".meals.category_id " . $id . " AND " . $db
            . ".meals_names.locale =" . $lang;

        $sql = "SELECT " . $db . ".meals_names.meals_id AS id, " . $db . ".meals_names.title,"
            . $db . ".meals_names.description, " . $db . ".meals_names.status
             FROM " . $db . ".meals_names
             INNER JOIN " . $db . ".meals
             ON meals.id = meals_names.meals_id
             WHERE " . $sqlFilter;


        if (!DiffTime::validDiffTime()) {
            $sql .= " AND status ='created'";
        }


        if (DiffTime::validDiffTime()) {
            $sql .= " AND meals_names.created_at between " . "'" . $diffTime . "'"
                . " AND NOW()"
                . " OR " . $sqlFilter . " AND locale= " . $lang
                . " AND updated_at between " . "'" . $diffTime . "'" . " AND NOW()"
                . " OR  " . $sqlFilter . " AND locale= " . $lang
                . " AND deleted_at between " . "'" . $diffTime . "'" . " AND NOW()";
        }



        if (isset($_GET['per_page'])) {
            $sql .= " LIMIT " . MetaParser::showRows() . "," . MetaParser::getPerPage();
        }


        $pdo = $this->dbConnInterface->connect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $row;
    }

    public function categoryRowCount()
    {

        # Returns Meals with a category passed as a parameter

        $id = "= " . $_GET["category"];



        if ($id == "= null") {
            $id = "IS NULL";
        }

        if ($id == "= !null") {
            $id = "IS NOT NULL";
        }


        $lang = '"' . $_GET["lang"] . '"';
        $diffTime = DiffTime::validDiffTime();
        $db = $this->dbName;

        $sqlFilter = $db . ".meals.category_id " . $id . " AND " . $db
            . ".meals_names.locale =" . $lang;


        $sql = "SELECT " . $db . ".meals_names.meals_id AS id, " . $db
            . ".meals_names.title, " . $db . ".meals_names.description, "
            . $db . ".meals_names.status
              FROM " . $db . ".meals_names
              INNER JOIN " . $db . ".meals
              ON meals.id = meals_names.meals_id
              WHERE " . $sqlFilter;

        if (!DiffTime::validDiffTime()) {
            $sql .= " AND status ='created'";
        }

        if (DiffTime::validDiffTime()) {
            $sql .= " AND meals_names.created_at between " . "'" . $diffTime . "'"
                . " AND NOW()"
                . " OR " . $sqlFilter . " AND locale= " . $lang
                . " AND updated_at between " . "'" . $diffTime . "'" . " AND NOW()"
                . " OR  " . $sqlFilter . " AND locale= " . $lang
                . " AND deleted_at between " . "'" . $diffTime . "'" . " AND NOW()";
        }



        $pdo = $this->dbConnInterface->connect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $row = $stmt->rowCount();

        return $row;
    }
}
