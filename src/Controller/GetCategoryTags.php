<?php

namespace Controller;

use Model\CategoryTags;

class GetCategoryTags
{
    protected $categoryTags;

    public function __construct(CategoryTags $categoryTags)
    {
        $this->categoryTags = $categoryTags;
    }




    /**
     *
     *@method getCategoryTags Returns meals data with implemented Categories and Tags
     *
     */


    public function getCategoryTags() #array $params)
    {
        $params = $_GET;
        $categoryTags = $this->categoryTags;
        $lang = $params["lang"];
        $category = $params["category"];
        $tagsID = $params["tags"];

        if ($params['category'] == "null") {
            $response = $categoryTags->selectCategoryTags([
                'lang' => $lang,
                'category' => 'IS NULL',
                'tags' => $tagsID
            ]);

            return $response;
        }

        if ($params['category'] == "!null") {
            $response = $categoryTags->selectCategoryTags([
                'lang' => $lang,
                "category" => "IS NOT NULL",
                "tags" => $tagsID
            ]);

            return $response;
        }

        $response = $categoryTags->selectCategoryTags([
            'lang' => $lang,
            'category' => " = " . $category,
            'tags' => $tagsID
        ]);

        return $response;
    }
}
