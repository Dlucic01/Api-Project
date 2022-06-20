<?php

namespace Upload;

use Database\DBConnInterface;
use Database\SQLConnection;
use Values\FakerLanguages;
use Faker;
use Values\Languages;
use Upload\SlugMaker;
use Values\TagsColumns;

require_once "../config/SQLConnection.php";
require_once "./GenerateSQL.php";
require_once "./SlugMaker.php";
require_once "../config/config.php";

class UploadTags
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

    public function uploadTags()
    {
        $pdo = $this->dbConnection->connect();

        $sql = "INSERT INTO jela_svijeta.tags VALUES(0)";

        $stmt = $pdo->prepare($sql);



        $stmt->execute();
        $tags_id = $pdo->lastInsertId();
        echo "<<<<<<<<<<<<<  " . $tags_id . "  >>>>>>>>>>>>>";

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
            "tags_id" => $tags_id,
            "locale" => $locale,
            "title" => $faker_cat,
            "slug" => $slug,
        ];

        print("<pre>" . print_r($params, true) . "</pre>");
        $pdo = $this->dbConnection->connect();


        $stmt = $pdo->prepare($sql);
        $tableValues = [
            "table"  => "tags_names",
            "column" => TagsColumns::$tagsColumns['tags_names'],
        ];


        $sql = $this->generateSQL->insert($tableValues);

        $stmt = $pdo->prepare($sql);




        for ($i = 0; $i < $lang_counter; $i++) {
            $stmt->bindValue($tableValues["column"][0], $params["tags_id"]);

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

$tags = new UploadTags($upload, $conn);
$tags->uploadTags();
