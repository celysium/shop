<?php

namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Requests\Category\StoreRequest;
use App\Modules\Admin\Requests\Category\UpdateRequest;
use App\Modules\Admin\Resources\Category\BriefResource;
use App\Modules\Admin\Resources\Category\DetailResource;
use App\Modules\Admin\Services\Category\CategoryService;
use App\Modules\Core\Models\Category;
use Celysium\Response\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

readonly class CategoryController
{
    public function __construct(private CategoryService $categoryService)
    {
    }

    public function index(Request $request): JsonResponse
    {
        $categories = $this->categoryService->index($request->all());

        return Response::collection(BriefResource::collection($categories));
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $category = $this->categoryService->store($request->validated());

        return Response::created(new DetailResource($category));
    }

    public function show(Category $category): JsonResponse
    {
        $category = $this->categoryService->show($category);

        return Response::info($category);
    }

    public function update(UpdateRequest $request, Category $category): JsonResponse
    {
        $category = $this->categoryService->update($category, $request->validated());

        return Response::success(new DetailResource($category));
    }

    public function destroy(Category $category): JsonResponse
    {
        $this->categoryService->destroy($category);

        return Response::success();
    }

}
