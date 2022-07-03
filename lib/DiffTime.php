<?php

namespace Values;

class DiffTime
{
    /**
     * Validate diff_time parameter
     */

    public static function validDiffTime()
    {

        $diffTime = $_GET['diff_time'];
        $diffTime = gmdate("Y-m-d H:i:s", $diffTime);

        if (
            isset($diffTime)
            && (int) $diffTime <= 0
            || (int) $diffTime > time()
        ) {
            echo "Diff time can't be <= 0 or > current UNIX time";
            return false;
        } elseif (!isset($_GET['diff_time'])) {

            return false;
        }
        return $diffTime;
    }
}
