<?php

namespace Upload;

use Database\DBConnInterface;
use Database\SQLConnection;
use Values\CategoryColumns;
use Values\FakerLanguages;
use Faker;
use Values\Languages;
use Upload\SlugMaker;

require_once "../config/SQLConnection.php";
require_once "./GenerateSQL.php";
require_once "./SlugMaker.php";
require_once "../config/config.php";

class UploadCategory
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

    public function uploadCategory()
    {
        $pdo = $this->dbConnection->connect();

        $sql = "INSERT INTO jela_svijeta.categories VALUES(0)";

        $stmt = $pdo->prepare($sql);



        $stmt->execute();
        $category_id = $pdo->lastInsertId();
        echo "<<<<<<<<<<<<<  " . $category_id . "  >>>>>>>>>>>>>";

        $pdo = null;

        $locale  = Languages::$locale;

        $lang_counter = count(FakerLanguages::$fakerLanguages);

        for ($i = 0; $i < $lang_counter; $i++) {
            $fakerLang = FakerLanguages::$fakerLanguages[$i];

            $faker = Faker\Factory::create($fakerLang);
            //Generate Faker Titles
            $faker_category = $faker->streetName;

            $faker_cat[] = $faker_category;
        }

        $slug = SlugMaker::slugMaker($faker_cat[0]);


        print("<pre>" . print_r($locale, true) . "</pre>");
        echo "------------------";
        print("<pre>" . print_r($faker_cat, true) . "</pre>");
        echo "------------------";
        echo $slug;

        $params = [
            "category_id" => $category_id,
            "locale" => $locale,
            "title" => $faker_cat,
            "slug" => $slug,
        ];

        print("<pre>" . print_r($params, true) . "</pre>");
        $pdo = $this->dbConnection->connect();


        $stmt = $pdo->prepare($sql);
        $tableValues = [
            "table"  => "category_names",
            "column" => CategoryColumns::$categoryColumns['category_names'],
        ];


        $sql = $this->generateSQL->insert($tableValues);

        $stmt = $pdo->prepare($sql);




        for ($i = 0; $i < $lang_counter; $i++) {
            $stmt->bindValue($tableValues["column"][0], $params["category_id"]);

            $stmt->bindValue($tableValues["column"][1], $params["locale"][$i]);

            $stmt->bindValue($tableValues["column"][2], $params["title"][$i]);

            $stmt->bindValue($tableValues["column"][3], $params["slug"]);

            $stmt->execute();
        }


        print("<pre>" . print_r($tableValues["column"], true) . "</pre>");

        $pdo = null;
    }
}



$conn = new SQLConnection();

$upload = new GenerateSQL($conn);

$category = new UploadCategory($upload, $conn);
$category->uploadCategory();
