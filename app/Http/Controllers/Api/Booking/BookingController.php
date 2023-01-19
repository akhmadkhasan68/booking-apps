<?php

namespace App\Http\Controllers\Api\Booking;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Repositories\BookingRepository;
use App\Http\Requests\Booking\BookingRequest;
use App\Http\Requests\PaginateRequest;
use App\Http\Services\BookingService;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    protected $bookingService;
    protected $bookingRepository;

    public function __construct(BookingService $bookingService, BookingRepository $bookingRepository)
    {
        $this->bookingService = $bookingService;
        $this->bookingRepository = $bookingRepository;
    }

    public function getAllBooking(PaginateRequest $request) {
        try {
            $request->merge([
                'member_id' => Auth::user()->member->id
            ]);

            $data = $this->bookingRepository->getBookingHistoryPaginate($request);

            return ApiResponseHelper::successResponse("Success get data bookings", $data);
        } catch (\Exception $e) {
            return ApiResponseHelper::errorResponse($e->getMessage(), $e->getCode());
        }
    }
    
    public function getDetailBooking($id) {
        try {
            $data = $this->bookingRepository->findOneOrFail(['id' => $id, 'member_id' => Auth::user()->member->id]);

            return ApiResponseHelper::successResponse("Success get detail booking", $data);;
        } catch (\Exception $e) {
            return ApiResponseHelper::errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function booking(BookingRequest $request) {
        try {
            $data = $this->bookingService->booking($request);
            
            return ApiResponseHelper::successResponse("Success create booking", $data);;
        } catch (\Exception $e) {
            return ApiResponseHelper::errorResponse($e->getMessage(), $e->getCode());
        }
    }
}
