<?php

namespace Controller;

use Database\SQLConnection;
use Model\MealsData;
use Model\With;
use Validators\UrlParameterController;
use Validators\ValidUrl;



class GetWith
{
    protected $with;

    public function __construct(With $with)
    {
        $this->with = $with;
    }



    /**
     *@method setWith Can generate Categories, Tags, Ingredients of a required meal
     */


    public function setWith($values, int $id)
    {
        $params = $_GET;

        if (!UrlParameterController::areValidParams()) {
            header("HTTP/1.0 404 Not Found");
            die("Not a valid request");
        }

        $language = ValidUrl::validate($params['lang']);
        $meals = $this->with;

        $response = $meals->selectWith([
            'table' => "jela_svijeta.meals",
            'lang' => $language,
            'id' => $id,
            'cti' => $values
        ]);

        if (empty($response)) {
            $response = "null";
        }

        $response = [$values => $response];

        return $response;
    }




    /**
     *
     *@method getWith Merges Categories, Tags, Ingredients of a required meal
     *
     */




    public function getWith(array $params, $meals_id)
    {
        if (!UrlParameterController::areValidParams()) {
            header("HTTP/1.0 404 Not Found");
            die("Not a valid request");
        }

        $params = $_GET;

        $api = [];




        $with_params[] = explode(',', $params['with']);


        $with_count = count($with_params[0]);

        $meals_id_count = count($meals_id);


        for ($i = 0; $i < $meals_id_count; $i++) {
            if ($with_count == 1) {
                $with_one = self::setWith($with_params[0][0], $meals_id[$i]['id']);

                $with = $with_one;
            }

            if ($with_count == 2) {
                $with_one = self::setWith($with_params[0][0], $meals_id[$i]['id']);

                $with_two = self::setWith($with_params[0][1], $meals_id[$i]['id']);

                $with = array_merge($with_one, $with_two);
            }
            if ($with_count == 3) {
                $with_one = self::setWith($with_params[0][0], $meals_id[$i]['id']);

                $with_two = self::setWith($with_params[0][1], $meals_id[$i]['id']);

                $with_three = self::setWith($with_params[0][2], $meals_id[$i]['id']);

                $with = array_merge($with_one, $with_two, $with_three);
            }

            $response = array_merge($meals_id[$i], $with);
            $api[] = $response;
        }

        return $api;
    }
}
