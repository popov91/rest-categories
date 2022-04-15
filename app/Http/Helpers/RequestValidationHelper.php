<?php

namespace App\Http\Helpers;

use App\Models\Category;

class RequestValidationHelper
{
    /**
     * @param array $names
     * @return array
     */
    public static function getCategoriesIdsByNames(array $names): array
    {
        return Category::select('id')->whereIn('name', $names)->get()->modelKeys();
    }
}
