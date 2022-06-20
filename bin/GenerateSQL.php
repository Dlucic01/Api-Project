<?php

namespace Upload;

use Database\DBConnInterface;
use Values\CategoryColumns;
use Values\FakerLanguages;


require_once "../config/SQLConnection.php";



class GenerateSQL
{

    /**
     *@method insert generates mysql statement and inserts values into database
     */

    public function insert(array $params)
    {



        #$pdo = $this->dbConnection->connect();

        $sql = "INSERT INTO jela_svijeta." . $params["table"] . " (";


        # Create column names

        foreach ($params["column"] as $columns) {
            $sql .= $columns . ", ";
        }
        $sql = rtrim($sql, ", ");
        $sql .= ") VALUES (";

        # Create sql column values
        foreach ($params["column"] as $bind_values) {
            $sql .= ":" . $bind_values . ", ";
        }
        $sql = rtrim($sql, ", ");
        $sql .= ")";

        echo $sql;
        return $sql;
    }
}


$test = [
    "param"  => "params",
    "table"  => "category_names",
    "column" => CategoryColumns::$categoryColumns['category_names'],
    "cti_id" => "1",
    "slug" => "slug-maker-2",
    "locale" => FakerLanguages::$fakerLanguages,
];
