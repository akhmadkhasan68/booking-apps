<?php

namespace App\Http\Controllers\Api\Room;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Repositories\RoomRepository;
use App\Http\Requests\PaginateRequest;
use App\Http\Requests\Room\BookingRequest;
use App\Http\Requests\Room\SearchAvailableRequest;
use App\Http\Requests\Room\SearchUnavailableRequest;

class RoomController extends Controller
{
    protected $roomRepository;

    public function __construct(RoomRepository $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }
    
    public function paginate(PaginateRequest $request) {
        try {
            $data = $this->roomRepository->paginate($request);

            return ApiResponseHelper::successResponse("Success get data rooms", $data);
        } catch (\Exception $e) {
            return ApiResponseHelper::errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function detail($id) {
        try {
            $data = $this->roomRepository->findOneOrFail(['id' => $id]);
    
            return ApiResponseHelper::successResponse("Success get data room detail", $data);
        } catch (\Exception $e) {
            return ApiResponseHelper::errorResponse($e->getMessage(), $e->getCode());
        }
    }
    
    public function searchAvailable(SearchAvailableRequest $request) {
        try {
            $data = $this->roomRepository->searchAvailable($request);

            return ApiResponseHelper::successResponse("Success search data room available", $data);
        } catch (\Exception $e) {
            return ApiResponseHelper::errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function searchUnvailable(SearchUnavailableRequest $request) {
        try {
            $data = $this->roomRepository->searchUnvailable($request);

            return ApiResponseHelper::successResponse("Success search data room unvailable", $data);
        } catch (\Exception $e) {
            return ApiResponseHelper::errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function schedules(PaginateRequest $request) {
        try {
            $data = $this->roomRepository->schedules($request);

            return ApiResponseHelper::successResponse("Success get data room schedules", $data);
        } catch (\Exception $e) {
            return ApiResponseHelper::errorResponse($e->getMessage(), $e->getCode());
        }
    }
    
    public function scheduleDetail($id) {
        try {
            $data = $this->roomRepository->scheduleDetail($id);

            return ApiResponseHelper::successResponse("Success get data room detail", $data);
        } catch (\Exception $e) {
            return ApiResponseHelper::errorResponse($e->getMessage(), $e->getCode());
        }
    }
}
