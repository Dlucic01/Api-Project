<?php

namespace Upload;

class SlugMaker
{
    /**
     *@method slugMaker creates a slug for Categories, Tags and Ingredients
     */


    public static function slugMaker($slug)
    {
        $slug = str_replace(" ", "-", $slug);
        $slug = strtolower($slug);
        return $slug;
    }
}
