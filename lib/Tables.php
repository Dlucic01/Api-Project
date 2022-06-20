<?php

namespace Values;

class Tables
{
    /**
     * @var array $tables Holds all tables
     */

    public static array $tables = [
        "category"    => ['categories', 'category_names'],
        "tags"        => ['tags', 'tags_names'],
        "ingredients" => ['ingredients', 'ingredients_names'],
        "meals"       => ['meals', 'meals_names', 'meals_tags', 'meals_ingredients'],
    ];
}
