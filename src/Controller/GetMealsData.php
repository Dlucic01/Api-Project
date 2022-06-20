<?php

namespace Controller;

use Validators\ValidUrl;
use Model\MealsData;
use Validators\UrlParameterController;

class GetMealsData
{
    protected $mealsData;

    public function __construct(MealsData $mealsData)
    {
        $this->mealsData = $mealsData;
    }



    /**
     *@method getMealData Returns all meals
     */


    public function getMealsData()
    {
        $params = $_GET;

        if (!UrlParameterController::areValidParams()) {
            header("HTTP/1.0 404 Not Found");
            die("Not a valid request");
        }
        $lang = ValidUrl::validate($params['lang']);

        $meals_values = $this->mealsData;

        $timeStamp = $params['diff_time'];

        $dateTime = gmdate("Y-m-d", $timeStamp);

        $values = [
            'table' => ".meals_names",
            'lang' => '"' . $lang . '"',
            'diff_time' => $dateTime,
        ];

        $response = $meals_values->returnMealsData($values);

        return $response;
    }
}
