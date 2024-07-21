<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Authenticate\LoginRequest;
use App\Repositories\Admin\Authenticate\AuthenticateRepositoryInterface;
use Celysium\Response\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthenticateController extends Controller
{
    public function __construct(private readonly AuthenticateRepositoryInterface $authenticateRepository)
    {
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $data = $this->authenticateRepository->login($request->validated());

        return Response::success($data);
    }

    public function logout(Request $request): JsonResponse
    {
        $this->authenticateRepository->logout($request->user());

        return Response::success();
    }
}
