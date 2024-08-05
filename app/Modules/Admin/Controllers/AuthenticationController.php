<?php

namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Requests\Authentication\ChangePasswordRequest;
use App\Modules\Admin\Requests\Authentication\ForgetRequest;
use App\Modules\Admin\Requests\Authentication\LoginRequest;
use App\Modules\Admin\Requests\Authentication\ResetRequest;
use App\Modules\Admin\Requests\Authentication\SetPasswordRequest;
use App\Modules\Admin\Requests\Authentication\UpdateRequest;
use App\Modules\Admin\Services\Authentication\AuthenticationServiceInterface;
use Celysium\Response\Response;
use Illuminate\Http\JsonResponse;

readonly class AuthenticationController
{
    public function __construct(private AuthenticationServiceInterface $authenticationService)
    {
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $data = $this->authenticationService->login($request->validated());

        return Response::success($data);
    }

    public function logout(): JsonResponse
    {
        $this->authenticationService->logout();

        return Response::success();
    }

    public function forget(ForgetRequest $request): JsonResponse
    {
        $data = $this->authenticationService->forget($request->validated());

        return Response::success($data);
    }

    public function reset(ResetRequest $request): JsonResponse
    {
        $data = $this->authenticationService->reset($request->validated());

        return Response::success($data);
    }

    public function setPassword(SetPasswordRequest $request): JsonResponse
    {
        $data = $this->authenticationService->reset($request->validated());

        return Response::success($data);
    }

    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        $this->authenticationService->reset($request->validated());

        return Response::success();
    }

    public function update(UpdateRequest $request): JsonResponse
    {
        $user = $this->authenticationService->reset($request->validated());

        return Response::success($user);
    }

    public function profile(): JsonResponse
    {
        $user = $this->authenticationService->profile();

        return Response::info($user);
    }


}
