<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\ProductCategory;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(Category::all());
    }

    /**
     * @param Category $category
     * @return JsonResponse
     */
    public function show(Category $category): JsonResponse
    {
        return response()->json($category);
    }

    /**
     * @param CategoryRequest $request
     * @return JsonResponse
     */
    public function store(CategoryRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $category = Category::create($validated);

        return response()->json($category, 201);
    }

    /**
     * @param CategoryRequest $request
     * @param Category $category
     * @return JsonResponse
     */
    public function update(CategoryRequest $request, Category $category): JsonResponse
    {
        $validated = $request->validated();
        $category->update($validated);

        return response()->json($category, 200);
    }

    /**
     * @param Category $category
     * @return JsonResponse
     */
    public function delete(Category $category): JsonResponse
    {
        $productCategories = ProductCategory::where('category_id', $category->id)->get();
        if ($productCategories->isNotEmpty()) {
            return response()->json([
                'error' => 'Невозможно удалить категорию к которой привязаны продукты'
            ], 400);
        }
        $category->delete();

        return response()->json(null, '204');
    }
}
