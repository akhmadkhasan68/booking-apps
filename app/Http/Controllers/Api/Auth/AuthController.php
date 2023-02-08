<?php
namespace App\Http\Controllers\Api\Auth;

use App\Constants\RolesConstant;
use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Services\AuthApiService;
use Illuminate\Http\Request;

class AuthController extends Controller {
  protected $authApiService;

  public function __construct(AuthApiService $authApiService)
  {
    $this->authApiService = $authApiService;
  }

  public function me(Request $request) {
    try {
      $data = $this->authApiService->me($request);

      return ApiResponseHelper::successResponse("Success get data user", $data);
    } catch (\Exception $e) {
      return ApiResponseHelper::errorResponse($e->getMessage(), $e->getCode());
    }
  }

  public function login(LoginRequest $request) {
    try {
      $data = $this->authApiService->login($request);

      return ApiResponseHelper::successResponse("Success login account", $data);
    } catch (\Exception $e) {
      return ApiResponseHelper::errorResponse($e->getMessage(), $e->getCode());
    }
  }
  
  public function register(RegisterRequest $request) {
    try {
      $data = $this->authApiService->register($request, RolesConstant::MEMBER);

      return ApiResponseHelper::successResponse("Success register account", $data);
    } catch (\Exception $e) {
      return ApiResponseHelper::errorResponse($e->getMessage(), $e->getCode());
    }
  }

  public function logout (Request $request) {
    try {
      $data = $this->authApiService->logout($request);

      return ApiResponseHelper::successResponse("Success logout account", $data);
    } catch (\Exception $e) {
      return ApiResponseHelper::errorResponse($e->getMessage(), $e->getCode());
    }
  }
}
