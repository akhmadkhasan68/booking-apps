<?php

namespace App\Http\Controllers\Api\Feedback;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Repositories\FeedbackRepository;
use App\Http\Requests\Feedback\FeedbackRequest;
use App\Http\Requests\PaginateRequest;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    protected $feedbackRepository;

    public function __construct(FeedbackRepository $feedbackRepository)
    {
        $this->feedbackRepository = $feedbackRepository;
    }

    public function feedbacks(PaginateRequest $request) {
        try {
            $data = $this->feedbackRepository->feedbacksPaginate($request);
            
            return ApiResponseHelper::successResponse("Success get data feedbacks", $data);
        } catch (\Exception $e) {
            return ApiResponseHelper::errorResponse($e->getMessage(), $e->getCode());
        }
    }
    
    public function feedbackDetail($id) {
        try {
            $data = $this->feedbackRepository->findOneOrFail(['id' => $id]);
            
            return ApiResponseHelper::successResponse("Success get data feedback detail", $data);
        } catch (\Exception $e) {
            return ApiResponseHelper::errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function create(FeedbackRequest $request) {
        try {
            $data = $this->feedbackRepository->create($request);

            return ApiResponseHelper::successResponse("Success create data feedback", $data);
        } catch (\Exception $e) {
            return ApiResponseHelper::errorResponse($e->getMessage(), $e->getCode());
        }
    }
}
