<?php

namespace App\Http\Controllers\Api\Booking;

use App\Http\Controllers\Controller;
use App\Http\Requests\Booking\BookingRequest;
use App\Http\Requests\PaginateRequest;
use App\Http\Services\BookingService;

class BookingController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function getAllBooking(PaginateRequest $request) {
        try {
            return $request;
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function booking(BookingRequest $request) {
        try {
            $data = $this->bookingService->booking($request);
            
            return response([
                'message' => 'success create data booking',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
