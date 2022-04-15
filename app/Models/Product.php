<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $name
 * @property int    $price
 * @property bool   $is_published
 */
class Product extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'price', 'is_published'];

    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class,
            'product_category', 'product_id', 'category_id');
    }
}
