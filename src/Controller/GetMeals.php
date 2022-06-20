<?php

namespace Controller;

use Validators\ValidUrl;
use Database\DBConnInterface;
use Database\SQLConnection;
use Model\Meals;
use Validators\UrlParameterController;

require("../../Validators/UrlParameter.php");
require_once "../Model/Meals.php";
require_once "../../vendor/autoload.php";


class GetMeals
{
    protected $meals;

    public function __construct(Meals $meals)
    {
        $this->meals = $meals;
    }



    /**
     *@method getMealData Returns all meals
     */


    public function getMeals()
    {
        $params = $_GET;

        if (!UrlParameterController::areValidParams()) {
            header("HTTP/1.0 404 Not Found");
            die("Not a valid request");
        }
        $language = ValidUrl::validate($params['lang']);

        $meals_values = $this->meals;


        $values = [
            'table' => "jela_svijeta.meals",
        ];

        $response = $meals_values->returnMeals($values);

        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
            | JSON_PARTIAL_OUTPUT_ON_ERROR);

        return $response;
    }
}
