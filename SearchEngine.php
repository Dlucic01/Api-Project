<?php

use Controller\GetCategoryTags;
use Controller\GetMealsCategory;
use Controller\GetMealsData;
use Controller\GetMealsTags;
use Controller\GetWith;
use Model\Category;
use Model\CategoryTags;
use Model\MealsData;
use Model\Tags;
use Model\With;
use Values\MetaParser;

require_once "./src/Model/With.php";
include_once "./lib/UrlParameter.php";
require_once "./lib/ValidUrl.php";
require_once "./src/Model/MealsData.php";
require_once "./src/Controller/GetMealsData.php";
require_once "./src/Controller/GetMealsCategory.php";
require_once "./src/Model/Category.php";
require_once "./src/Model/Tags.php";
require_once "./src/Controller/GetMealsTags.php";
require_once "./src/Model/With.php";
require_once "./src/Controller/GetWith.php";
require_once "./src/Model/CategoryTags.php";
require_once "./src/Controller/GetCategoryTags.php";
require_once "./config/config.php";
require_once "./config/SQLConnection.php";


class SearchEngine
{
    protected $mealsModel;
    protected $categoryModel;
    protected $tagsModel;
    protected $withModel;
    protected $categoryTagsModel;

    private $mealsController;
    private $categoryController;
    private $tagsController;
    private $withController;
    private $categoryTagsController;


    public $count;
    public array $searchParams = ["lang", "category", "tags", "with"];


    public function __construct(
        MealsData $mealsModel,
        GetMealsData $mealsController,
        Tags $tagsModel,
        GetMealsTags $tagsController,
        Category $categoryModel,
        GetMealsCategory $categoryController,
        With $withModel,
        GetWith $withController,
        CategoryTags $categoryTagsModel,
        GetCategoryTags $categoryTagsController
    ) {
        $this->mealsModel = $mealsModel;
        $this->mealsController = $mealsController;

        $this->tagsModel = $tagsModel;
        $this->tagsController = $tagsController;

        $this->categoryModel = $categoryModel;
        $this->categoryController = $categoryController;

        $this->withModel = $withModel;
        $this->withController = $withController;

        $this->categoryTagsModel = $categoryTagsModel;
        $this->categoryTagsController = $categoryTagsController;
    }

    public function getParameterCount(array $params)
    {
        foreach ($params as $key => $val) {
            if (in_array($key, $this->searchParams)) {
                $this->count += 1;
            }
        }
        return $this->count;
    }



    /**
     *
     *@method getSearchParams returns an array of parameters
     *
     */


    public function getSearchParams()
    {
        $paramsHolder = [];

        foreach ($_GET as $key => $val) {
            if (in_array($key, $this->searchParams)) {
                $paramsHolder[] = $key;
            }
        }

        for ($i = 0; $i < count($paramsHolder); $i++) {
            if ($paramsHolder[$i] == 'lang') {
                unset($paramsHolder[$i]);
            }
        }
        return $paramsHolder;
    }

    public function returnResponse(array $params)
    {
        $count = $this->getParameterCount($params);
        $searchParams = $this->getSearchParams();


        if ($count == 1) {
            $response = $this->mealsController->getMealsData();
            $meta = MetaParser::parser($this->mealsModel->mealsRowCount());
            $links = MetaParser::getLinks($this->mealsModel->mealsRowCount());
            $response = ['data' => $response];
            $response = array_merge($meta, $response, $links);
        }

        if (
            $count == 2
            && isset($params["tags"])
        ) {
            $response = $this->tagsController->getTMeals();
            $meta = MetaParser::parser($this->tagsModel->tagsRowCount());
            $links = MetaParser::getLinks($this->tagsModel->tagsRowCount());
            $response = ['data' => $response];
            $response = array_merge($meta, $response, $links);
        }

        if (
            $count == 2
            && isset($params["category"])
        ) {
            $response = $this->categoryController->getCMeals();
            $meta = MetaParser::parser($this->categoryModel->categoryRowCount());
            $links = MetaParser::getLinks($this->categoryModel->categoryRowCount());
            $response = ['data' => $response];
            $response = array_merge($meta, $response, $links);
        }

        if (
            $count == 2
            && isset($params["with"])
        ) {
            $response = $this->withController->getWith($_GET, $this->mealsController->getMealsData());
            $meta = MetaParser::parser($this->mealsModel->mealsRowCount());
            $links = MetaParser::getLinks($this->mealsModel->mealsRowCount());
            $response = ['data' => $response];
            $response = array_merge($meta, $response, $links);
        }

        if (
            $count == 3
            && isset($params["category"])
            && isset($params["with"])
        ) {
            $response = $this->withController->getWith($_GET, $this->categoryController->getCMeals());
            $meta = MetaParser::parser($this->categoryModel->categoryRowCount());
            $links = MetaParser::getLinks($this->categoryModel->categoryRowCount());
            $response = ['data' => $response];
            $response = array_merge($meta, $response, $links);
        }

        if (
            $count == 3
            && isset($params["tags"])
            && isset($params["with"])
        ) {
            $response = $this->withController->getWith($_GET, $this->tagsController->getTMeals());
            $meta = MetaParser::parser($this->tagsModel->tagsRowCount());
            $links = MetaParser::getLinks($this->tagsModel->tagsRowCount());
            $response = ['data' => $response];
            $response = array_merge($meta, $response, $links);
        }

        if (
            $count == 3
            && isset($params["category"])
            && isset($params["tags"])
        ) {
            $response = $this->categoryTagsController->getCategoryTags();
            $meta = MetaParser::parser($this->categoryTagsModel->categoryTagsRowCount());
            $links = MetaParser::getLinks($this->categoryTagsModel->categoryTagsRowCount());
            $response = ['data' => $response];
            $response = array_merge($meta, $response, $links);
        }

        if ($count == 4) {
            $response = $this->withController->getWith($_GET, $this->categoryTagsController->getCategoryTags());
            $meta = MetaParser::parser($this->categoryTagsModel->categoryTagsRowCount());
            $links = MetaParser::getLinks($this->categoryTagsModel->categoryTagsRowCount());
            $response = ['data' => $response];
            $response = array_merge($meta, $response, $links);
        }
        return $response;
    }
}
