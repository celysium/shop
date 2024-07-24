<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Authentication\ChangePasswordRequest;
use App\Http\Requests\Admin\Authentication\ForgetRequest;
use App\Http\Requests\Admin\Authentication\LoginRequest;
use App\Http\Requests\Admin\Authentication\ResetRequest;
use App\Http\Requests\Admin\Authentication\SetPasswordRequest;
use App\Http\Requests\Admin\Authentication\UpdateRequest;
use App\Services\Admin\Authentication\AuthenticationServiceInterface;
use Celysium\Response\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function __construct(private readonly AuthenticationServiceInterface $authenticateRepository)
    {
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $data = $this->authenticateRepository->login($request->validated());

        return Response::success($data);
    }

    public function logout(): JsonResponse
    {
        $this->authenticateRepository->logout();

        return Response::success();
    }

    public function forget(ForgetRequest $request): JsonResponse
    {
        $data = $this->authenticateRepository->forget($request->validated());

        return Response::success($data);
    }

    public function reset(ResetRequest $request): JsonResponse
    {
        $data = $this->authenticateRepository->reset($request->validated());

        return Response::success($data);
    }

    public function setPassword(SetPasswordRequest $request): JsonResponse
    {
        $data = $this->authenticateRepository->reset($request->validated());

        return Response::success($data);
    }

    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        $this->authenticateRepository->reset($request->validated());

        return Response::success();
    }

    public function update(UpdateRequest $request): JsonResponse
    {
        $user = $this->authenticateRepository->reset($request->validated());

        return Response::success($user);
    }

    public function profile(): JsonResponse
    {
        $user = $this->authenticateRepository->profile();

        return Response::info($user);
    }


}
