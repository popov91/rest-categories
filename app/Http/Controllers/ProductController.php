<?php

namespace App\Http\Controllers;

use App\Http\Helpers\ProductOptionalParamsHelper;
use App\Http\Helpers\RequestValidationHelper;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $products = Product::query();
        ProductOptionalParamsHelper::getParams($products);

        return response()->json($products->get());
    }

    /**
     * @param Product $product
     * @return JsonResponse
     */
    public function show(Product $product): JsonResponse
    {
        return response()->json($product);
    }

    /**
     * @param ProductRequest $request
     * @return JsonResponse
     */
    public function store (ProductRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $product = Product::create($validated);
        $categoryIds = RequestValidationHelper::getCategoriesIdsByNames($validated['categories']);
        $product->categories()->attach($categoryIds);

        return response()->json($product, 201);
    }

    /**
     * @param ProductRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(ProductRequest $request, Product $product): JsonResponse
    {
        $validated = $request->validated();
        $product->update($validated);
        $categoryIds = RequestValidationHelper::getCategoriesIdsByNames($validated['categories']);
        $product->categories()->sync($categoryIds);

        return response()->json($product, 200);
    }

    /**
     * @param Product $product
     * @return JsonResponse
     */
    public function delete(Product $product): JsonResponse
    {
        $product->delete();

        return response()->json(null, '204');
    }
}
