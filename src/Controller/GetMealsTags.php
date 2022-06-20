<?php

namespace Controller;

use Model\Tags;
use Validators\UrlParameterController;
use Validators\ValidUrl;

class GetMealsTags
{
    protected $tags;
    protected $mealData;
    protected $mealsData;



    public function __construct(Tags $tags)
    {
        $this->tags = $tags;
    }
    public function getTMeals()
    {
        $params = $_GET;
        $id = $params['tags'];

        if (!UrlParameterController::areValidParams()) {
            header("HTTP/1.0 404 Not Found");
            die("Not a valid request");
        }

        $language = ValidUrl::validate($params['lang']);
        $meals = $this->tags;

        $response = $meals->returnTMeals([
            'table' => "jela_svijeta.meals_" . $language,
            'lang' => '"' . $language . '"',
            'cti' => "tags",
            'id' => $id
        ]);

        return $response;
    }
}
