<?php

namespace Values;

class DiffTime
{
    /**
     * Validate diff_time parameter
     */

    public static function validDiffTime(): bool
    {
        if (isset($_GET['diff_time'])
        && (int) $_GET['diff_time'] <= 0
        || (int) $_GET['diff_time'] > time()
        ) {
            echo "Diff time can't be <= 0 or > current time()";
            return false;
        } elseif (!isset($_GET['diff_time'])) {
            return false;
        }
        return true;
    }
}
