<?php

use Controller\GetCategoryTags;
use Controller\GetMealsCategory;
use Controller\GetMealsData;
use Controller\GetMealsTags;
use Controller\GetWith;
use Database\SQLConnection;
use Model\Category;
use Model\CategoryTags;
use Model\MealsData;
use Model\Tags;
use Model\With;

require_once "./SearchEngine.php";

require_once("./vendor/autoload.php");

header("Content-Type: application/json; charset=utf-8");

$conn = new SQLConnection();

$mealsConn = new MealsData($conn);
$mealsValues = new GetMealsData($mealsConn);

$tagsConn = new Tags($conn);
$tagsValues = new GetMealsTags($tagsConn);

$categoryConn = new Category($conn);
$categoryValues = new GetMealsCategory($categoryConn);

$withConn = new With($conn);
$withValues = new GetWith($withConn);

$categoryTagsConn = new CategoryTags($conn);
$categoryTagsValues = new GetCategoryTags($categoryTagsConn);


$search = new SearchEngine(
    $mealsConn,
    $mealsValues,
    $tagsConn,
    $tagsValues,
    $categoryConn,
    $categoryValues,
    $withConn,
    $withValues,
    $categoryTagsConn,
    $categoryTagsValues
);
$response = $search->returnResponse($_GET);

#echo "<pre>";
echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_PARTIAL_OUTPUT_ON_ERROR);
#echo "</pre>";
