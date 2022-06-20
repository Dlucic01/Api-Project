<?php

namespace Upload;

use Database\DBConnInterface;
use Database\SQLConnection;
use Values\FakerLanguages;
use Faker;
use Values\Languages;
use Upload\SlugMaker;
use Values\IngredientsColumns;

require_once "../config/SQLConnection.php";
require_once "./GenerateSQL.php";
require_once "./SlugMaker.php";
require_once "../config/config.php";


class UploadIngredients
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

    public function uploadIngredients()
    {
        $pdo = $this->dbConnection->connect();

        $sql = "INSERT INTO jela_svijeta.ingredients VALUES(0)";

        $stmt = $pdo->prepare($sql);



        $stmt->execute();
        $ingredients_id = $pdo->lastInsertId();
        echo "<<<<<<<<<<<<<  " . $ingredients_id . "  >>>>>>>>>>>>>";

        $pdo = null;

        $locale  = Languages::$locale;

        $lang_counter = count(FakerLanguages::$fakerLanguages);

        for ($i = 0; $i < $lang_counter; $i++) {
            $fakerLang = FakerLanguages::$fakerLanguages[$i];

            $faker = Faker\Factory::create($fakerLang);

            //Generate Faker Titles
            $faker_category = $faker->company;

            $faker_cat[] = $faker_category;
        }

        $slug = [
            0 => SlugMaker::slugMaker($faker_cat[0]),
            1 => SlugMaker::slugMaker($faker_cat[1]),
            2 => SlugMaker::slugMaker($faker_cat[2]),
        ];

        print("<pre>" . print_r($locale, true) . "</pre>");
        echo "------------------";
        print("<pre>" . print_r($faker_cat, true) . "</pre>");
        echo "------------------";
        echo $slug;

        $params = [
            "ingredients_id" => $ingredients_id,
            "locale" => $locale,
            "title" => $faker_cat,
            "slug" => $slug,
        ];

        print("<pre>" . print_r($params, true) . "</pre>");
        $pdo = $this->dbConnection->connect();


        $stmt = $pdo->prepare($sql);
        $tableValues = [
            "table"  => "ingredients_names",
            "column" => IngredientsColumns::$ingredientsColumns['ingredients_names']
        ];


        $sql = $this->generateSQL->insert($tableValues);

        $stmt = $pdo->prepare($sql);




        for ($i = 0; $i < $lang_counter; $i++) {
            $stmt->bindValue($tableValues["column"][0], $params["ingredients_id"]);

            $stmt->bindValue($tableValues["column"][1], $params["locale"][$i]);

            $stmt->bindValue($tableValues["column"][2], $params["title"][$i]);

            $stmt->bindValue($tableValues["column"][3], $params["slug"][$i]);

            $stmt->execute();
        }


        print("<pre>" . print_r($tableValues["column"], true) . "</pre>");

        $pdo = null;
    }
}



$conn = new SQLConnection();

$upload = new GenerateSQL($conn);

$ingredients = new UploadIngredients($upload, $conn);
$ingredients->uploadIngredients();
