<?php

namespace Values;

use Validators\UrlParameterController;

class PerPage
{
    /**
     *@method perPage sets per_page request
     */


    public function perPage()
    {
        $params = $_GET;

        if (!UrlParameterController::areValidParams()) {
            header("HTTP/1.0 404 Not Found");
            die("Not a valid request");
        }
        if (isset($params['per_page'])) {
            $per_page = $params['per_page'];
        } else {
            $per_page = null;
        }
        return $per_page;
    }
}
