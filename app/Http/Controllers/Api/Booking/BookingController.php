<?php

namespace App\Http\Controllers\Api\Booking;

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

            return $this->bookingRepository->getBookingHistoryPaginate($request);
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ]);
        }
    }
    
    public function getDetailBooking($id) {
        try {
            return $this->bookingRepository->findOneOrFail(['id' => $id, 'member_id' => Auth::user()->member->id]);
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
