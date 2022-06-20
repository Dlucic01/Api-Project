<?php

namespace Controller;

use Model\Category;
use Validators\UrlParameterController;
use Validators\ValidUrl;


class GetMealsCategory
{
    protected $category;
    protected $mealData;
    protected $mealsData;



    public function __construct(Category $category)
    {
        $this->category = $category;
    }



    /**
     *
     *@method getCMeals Returns meals data with implemented categories
     *
     */


    public function getCMeals()
    {
        $params = $_GET;

        if (!UrlParameterController::areValidParams()) {
            header("HTTP/1.0 404 Not Found");
            die("Not a valid request");
        }

        $language = ValidUrl::validate($params['lang']);
        $meals = $this->category;



        # Returns all meals that have categories "NULL"

        if ($_GET['category'] == "null") {
            $response = $meals->returnCMealsNull([
                'lang' => '"' . $language . '"',
                'cti' => "category",
                'category_table' => $params['category'],
                'id' => "IS NULL"
            ]);
        }



        # Returns all meals that have categories not null

        if ($_GET['category'] == "!null") {
            $response = $meals->returnCMeals([
                'lang' => '"' . $language . '"',
                'category_table' => $params['category'],

                'table' => "jela_svijeta.meals_names",
                'cti' => "category",
                'id' => "IS NOT NULL"
            ]);
        }



        # Returns all meals that have id of $params['category']

        if ($_GET['category'] != "null" && $_GET['category'] != "!null") {
            $response = $meals->returnCMeals([
                'table' => "jela_svijeta.meals_names",
                'lang' => '"' . $language . '"',
                'cti' => "category",
                'id' => "=" . $params['category']
            ]);
        }


        return $response;
    }
}
