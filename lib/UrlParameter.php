<?php

namespace Validators;

use Values\Languages;

class UrlParameterController
{
    public static array $validParameters = [
        'lang',
        'category',
        'tags',
        'with',
        'per_page',
        'page',
        'diff_time',
    ];

    # if requested url params are valid return true, if not 404
    public static function areValidParams(): bool
    {
        foreach ($_GET as $key => $v) {
            if (!in_array($key, self::$validParameters)) {
                header("HTTP/1.0 404 Not Found");
                die("404 Not Found");
                return false;
            }
        }
        return true;
    }

    public static function isValidUrl(): bool
    {
        for ($i = 0; $i < count(Languages::$locale); $i++) {
            if (
                self::areValidParams()
                && in_array($_GET['lang'], Languages::$locale)
            ) {
                return true;
            }
            return false;
        }
    }
}
