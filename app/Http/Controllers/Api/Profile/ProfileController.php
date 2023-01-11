<?php

namespace App\Http\Controllers\Api\Profile;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UpdateProfileRequest;
use App\Http\Services\AuthApiService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $authApiService;

    public function __construct(AuthApiService $authApiService)
    {
        $this->authApiService = $authApiService;
    }
    
    public function updateMemberProfile(UpdateProfileRequest $request) {
        try {
            $data = $this->authApiService->updateMemberProfile($request);

            return ApiResponseHelper::successResponse("Success update profile", $data);
        } catch (\Exception $e) {
            return ApiResponseHelper::errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function updatePhoto() {
        
    }
}
