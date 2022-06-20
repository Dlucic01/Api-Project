<?php

namespace Values;

class MealsColumns
{
    /**
     * @var array|\string[][]
     */
    public static array $mealsColumns = [
        'meals'             => ['id', 'category_id', 'status', 'created_at'],
        'meals_names'       => ['meals_id', 'locale', 'title', 'description'],
        'meals_tags'        => ['meals_id', 'tags_id'],
        'meals_ingredients' => ['meals_id', 'ingredients_id'],

    ];
}
