<?php

namespace App\Modules\Panel\Controllers;

use App\Modules\Panel\Requests\Banner\StoreRequest;
use App\Modules\Panel\Requests\Banner\UpdateRequest;
use App\Modules\Panel\Resources\Banner\BriefResource;
use App\Modules\Panel\Resources\Banner\DetailResource;
use App\Modules\Panel\Services\Banner\BannerServiceInterface;
use App\Modules\Core\Models\Banner;
use Celysium\Response\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

readonly class BannerController
{
    public function __construct(private BannerServiceInterface $bannerService)
    {
    }

    public function index(Request $request): JsonResponse
    {
        $banners = $this->bannerService->index($request->all());

        return Response::collection(BriefResource::collection($banners));
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $banner = $this->bannerService->store($request->validated());

        return Response::created(new DetailResource($banner));
    }

    public function show(Banner $banner): JsonResponse
    {
        $banner = $this->bannerService->show($banner);

        return Response::info($banner);
    }

    public function update(UpdateRequest $request, Banner $banner): JsonResponse
    {
        $banner = $this->bannerService->update($banner, $request->validated());

        return Response::success(new DetailResource($banner));
    }

    public function destroy(Banner $banner): JsonResponse
    {
        $this->bannerService->destroy($banner);

        return Response::success();
    }

}
