<?php

namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Requests\Widget\StoreRequest;
use App\Modules\Admin\Requests\Widget\UpdateRequest;
use App\Modules\Admin\Resources\Widget\BriefResource;
use App\Modules\Admin\Resources\Widget\DetailResource;
use App\Modules\Admin\Services\Widget\WidgetServiceInterface;
use App\Modules\Core\Models\Widget;
use Celysium\Response\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

readonly class WidgetController
{
    public function __construct(private WidgetServiceInterface $categoryService)
    {
    }

    public function index(Request $request): JsonResponse
    {
        $categories = $this->categoryService->index($request->all());

        return Response::collection(BriefResource::collection($categories));
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $widget = $this->categoryService->store($request->validated());

        return Response::created(new DetailResource($widget));
    }

    public function show(Widget $widget): JsonResponse
    {
        $widget = $this->categoryService->show($widget);

        return Response::info(new DetailResource($widget));
    }

    public function update(UpdateRequest $request, Widget $widget): JsonResponse
    {
        $widget = $this->categoryService->update($widget, $request->validated());

        return Response::success(new DetailResource($widget));
    }

    public function destroy(Widget $widget): JsonResponse
    {
        $this->categoryService->destroy($widget);

        return Response::success();
    }

}
