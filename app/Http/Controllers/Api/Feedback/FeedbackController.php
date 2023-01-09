<?php

namespace App\Http\Controllers\Api\Feedback;

use App\Http\Controllers\Controller;
use App\Http\Requests\Feedback\FeedbackRequest;
use App\Http\Requests\PaginateRequest;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function feedbackByRoom(PaginateRequest $request, $id) {
        try {
            return $request;
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function create(FeedbackRequest $request) {
        try {
            return $request;
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ]);
        }
    }
}
