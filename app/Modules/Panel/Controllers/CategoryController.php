<?php

namespace App\Modules\Panel\Controllers;

use App\Modules\Panel\Requests\Category\StoreRequest;
use App\Modules\Panel\Requests\Category\UpdateRequest;
use App\Modules\Panel\Resources\Category\BriefResource;
use App\Modules\Panel\Resources\Category\ChildrenResource;
use App\Modules\Panel\Resources\Category\DetailResource;
use App\Modules\Panel\Resources\Category\TreeResource;
use App\Modules\Panel\Services\Category\CategoryServiceInterface;
use App\Modules\Core\Models\Category;
use Celysium\Response\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

readonly class CategoryController
{
    public function __construct(private CategoryServiceInterface $categoryService)
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

    public function children(Category $category): JsonResponse
    {
        $categories = $this->categoryService->children($category);

        return Response::collection(ChildrenResource::collection($categories));
    }

    public function tree(Category $category): JsonResponse
    {
        $category = $this->categoryService->tree($category);

        return Response::collection(new TreeResource($category));
    }

}
