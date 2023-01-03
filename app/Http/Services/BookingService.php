<?php
namespace App\Http\Services;

use App\Http\Repositories\BookingRepository;
use App\Http\Repositories\RoomRepository;
use App\Http\Requests\Booking\BookingRequest;
use Carbon\Carbon;
use Exception;

class BookingService {
    protected $roomRepository;
    protected $bookingRepository;

    public function __construct()
    {
        $this->roomRepository = new RoomRepository();
        $this->bookingRepository = new BookingRepository();
    }

    public function booking(BookingRequest $request) {
        try {
            $name = $request->name;
            $nip = $request->nip;
            $phone = $request->phone;
            $startDate = $request->start_date;
            $endDate = $request->end_date;
            $participant = $request->participant;
            $description = $request->description;
            $divisionId = $request->division_id;
            $roomId = $request->room_id;

            $availableRoomIds = collect($this->roomRepository->getAvailableRoom($startDate, $endDate))->pluck('id')->toArray();

            if(!in_array($roomId, $availableRoomIds)) {
                throw new Exception('Room has been booked', 422);
            }

            return $this->bookingRepository->create([
                'member_id' => auth()->user()->member->id,
                'room_id' => (int)$roomId,
                'booking_date' => Carbon::now()->format('Y-m-d H:i:s'),
                'booking_start_date' => $startDate,
                'booking_end_date' => $endDate,
                'name' => $name,
                'nip' => $nip,
                'phone' => $phone,
                'description' => $description,
                'participant' => $participant,
                'division_id' => (int)$divisionId
            ]);
          } catch (\Exception $e) {
            throw $e;
          }
    }
}
