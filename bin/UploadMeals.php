<?php

namespace Upload;

use Database\DBConnInterface;
use Database\SQLConnection;
use Values\FakerLanguages;
use Faker;
use Values\Languages;
use Values\MealsColumns;

require_once "../config/SQLConnection.php";
require_once "./GenerateSQL.php";


class UploadMeals
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

    public function uploadMeals()
    {
        $pdo = $this->dbConnection->connect();

        $sql = 'INSERT INTO jela_svijeta.meals (category_id) VALUES(NULL)';

        $stmt = $pdo->prepare($sql);



        $stmt->execute();
        $meals_id = $pdo->lastInsertId();
        echo "<<<<<<<<<<<<<  " . $meals_id . "  >>>>>>>>>>>>>";

        $pdo = null;

        $locale  = Languages::$locale;

        $lang_counter = count(FakerLanguages::$fakerLanguages);

        $faker_cat = array();
        $meals_desc = array();

        for ($i = 0; $i < $lang_counter; $i++) {
            $fakerLang = FakerLanguages::$fakerLanguages[$i];

            $faker = Faker\Factory::create($fakerLang);
            //Generate Faker Titles
            $faker_category = $faker->company;

            $faker_cat[] = $faker_category;
        }

        for ($i = 0; $i < $lang_counter; $i++) {
            $fakerLang = FakerLanguages::$fakerLanguages[$i];

            $faker = Faker\Factory::create($fakerLang);
            //Generate Faker Titles
            $meals_description = $faker->country;
            $meals_desc[] = $meals_description;
        }



        print("<pre>" . print_r($locale, true) . "</pre>");
        echo "------------------";
        print("<pre>" . print_r($faker_cat, true) . "</pre>");
        echo "------------------";

        $params = [
            "meals_id" => $meals_id,
            "locale" => $locale,
            "title" => $faker_cat,
            "description" => $meals_desc,
        ];

        print("<pre>" . print_r($params, true) . "</pre>");
        $pdo = $this->dbConnection->connect();


        $stmt = $pdo->prepare($sql);
        $tableValues = [
            "table"  => "meals_names",
            "column" => MealsColumns::$mealsColumns['meals_names'],
        ];


        $sql = $this->generateSQL->insert($tableValues);

        $stmt = $pdo->prepare($sql);




        for ($i = 0; $i < $lang_counter; $i++) {
            $stmt->bindValue($tableValues["column"][0], $params["meals_id"]);

            $stmt->bindValue($tableValues["column"][1], $params["locale"][$i]);

            $stmt->bindValue($tableValues["column"][2], $params["title"][$i]);

            $stmt->bindValue($tableValues["column"][3], $params["description"][$i]);

            $stmt->execute();
        }


        print("<pre>" . print_r($tableValues["column"], true) . "</pre>");

        $pdo = null;
    }
}



$conn = new SQLConnection();

$upload = new GenerateSQL($conn);

$meals = new UploadMeals($upload, $conn);
$meals->uploadMeals();
