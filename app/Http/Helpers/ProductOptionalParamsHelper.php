<?php

namespace App\Http\Helpers;

use Illuminate\Database\Eloquent\Builder;

class ProductOptionalParamsHelper
{
    /**
     * @param Builder $products
     * @return void
     */
    public static function getParams(Builder $products)
    {
        optional(request('name'), fn(string $name) => $products->whereFullText('name', $name)->get());
        optional(request('category_id'), function(string $category_id) use ($products) {
            $products->join('product_category', 'products.id', '=', 'product_category.product_id')
                ->where('product_category.category_id', $category_id);
        });
        optional(request('price_from'), fn(string $price_from) => $products->where('price', '>=', $price_from));
        optional(request('price_to'), fn(string $price_to) => $products->where('price', '>=', $price_to));
        optional(request('published'), fn(string $published) => $products->where('is_published', '=', $published));
        optional(request('deleted'), fn(string $deleted) => (filter_var($deleted, FILTER_VALIDATE_BOOLEAN)) ? $products->withTrashed() : '');
    }
}
