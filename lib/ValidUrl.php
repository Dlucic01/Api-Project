<?php

namespace Validators;

class ValidUrl
{
    public static function validate(string $url): string
    {
        $url = trim($url);
        $url = htmlspecialchars($url);

        return $url;
    }
}
