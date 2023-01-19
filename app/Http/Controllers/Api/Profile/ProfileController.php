<?php

namespace App\Http\Controllers\Api\Profile;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UpdatePhotoProfileRequest;
use App\Http\Requests\Auth\UpdateProfileRequest;
use App\Http\Services\AuthApiService;
use App\Http\Services\UserService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $authApiService;
    protected $userService;

    public function __construct(AuthApiService $authApiService, UserService $userService)
    {
        $this->authApiService = $authApiService;
        $this->userService = $userService;
    }
    
    public function updateMemberProfile(UpdateProfileRequest $request) {
        try {
            $data = $this->authApiService->updateMemberProfile($request);

            return ApiResponseHelper::successResponse("Success update profile", $data);
        } catch (\Exception $e) {
            return ApiResponseHelper::errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function updatePhoto(UpdatePhotoProfileRequest $request) {
        try {
            $data = $this->userService->updatePhotoProfile($request);

            return ApiResponseHelper::successResponse("Success update photo profile", $data);
        } catch (\Exception $e) {
            return ApiResponseHelper::errorResponse($e->getMessage(), $e->getCode());
        }
    }
}
