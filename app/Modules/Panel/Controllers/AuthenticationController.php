<?php

namespace App\Modules\Panel\Controllers;

use App\Modules\Panel\Requests\Authentication\ChangePasswordRequest;
use App\Modules\Panel\Requests\Authentication\CheckRequest;
use App\Modules\Panel\Requests\Authentication\ForgetRequest;
use App\Modules\Panel\Requests\Authentication\LoginRequest;
use App\Modules\Panel\Requests\Authentication\OTPRequest;
use App\Modules\Panel\Requests\Authentication\ResetRequest;
use App\Modules\Panel\Requests\Authentication\SetPasswordRequest;
use App\Modules\Panel\Requests\Authentication\UpdateRequest;
use App\Modules\Panel\Services\Authentication\AuthenticationServiceInterface;
use Celysium\Response\Response;
use Illuminate\Http\JsonResponse;

readonly class AuthenticationController
{
    public function __construct(private AuthenticationServiceInterface $authenticationService)
    {
    }

    public function check(CheckRequest $request): JsonResponse
    {
        $data = $this->authenticationService->check($request->validated());

        return Response::success($data);
    }

    public function otp(OTPRequest $request): JsonResponse
    {
        $data = $this->authenticationService->otp($request->validated());

        return Response::success($data);
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
