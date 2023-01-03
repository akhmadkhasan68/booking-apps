<?php
namespace App\Http\Controllers\Api\Auth;

use App\Constants\RolesConstant;
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

  public function user(Request $request) {
    $data = $this->authApiService->user($request);

    return response($data);
  }

  public function login(LoginRequest $request) {
    $data = $this->authApiService->login($request);

    return response($data);
  }
  
  public function register(RegisterRequest $request) {
    $data = $this->authApiService->register($request, RolesConstant::MEMBER);

    return response($data);
  }

  public function logout (Request $request) {
    $data = $this->authApiService->logout($request);

    return response($data);
  }
}
