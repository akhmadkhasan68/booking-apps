<?php
namespace App\Http\Services;

use App\Http\Repositories\BookingRepository;
use App\Http\Repositories\MemberRepository;
use App\Http\Repositories\RoomRepository;
use App\Http\Requests\Booking\BookingRequest;
use Carbon\Carbon;
use Exception;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

class BookingService {
    protected $roomRepository;
    protected $bookingRepository;
    protected $memberRepository;

    public function __construct()
    {
        $this->roomRepository = new RoomRepository();
        $this->bookingRepository = new BookingRepository();
        $this->memberRepository = new MemberRepository();
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
            $participantType = $request->participant_type;
            $divisionType = $request->division_type;

            $availableRoomIds = collect($this->roomRepository->getAvailableRoom($startDate, $endDate))->pluck('id')->toArray();

            if(!in_array($roomId, $availableRoomIds)) {
                throw new Exception('Room has been booked', 422);
            }

            $member = $this->memberRepository->findOneOrFail([
                'user_id' => auth()->user()->id
            ]);

            $data = [
                'member_id' => $member->id,
                'room_id' => (int)$roomId,
                'booking_date' => Carbon::now()->format('Y-m-d H:i:s'),
                'booking_start_date' => $startDate,
                'booking_end_date' => $endDate,
                'name' => $name,
                'nip' => $nip,
                'phone' => $phone,
                'description' => $description,
                'participant' => $participant,
                'division_id' => (int)$divisionId,
                'participant_type' => $participantType,
                'division_type' => $divisionType,
            ];

            //upload image
            if($request->hasFile('attachment')) {
                $attachment = $request->file('attachment');
                $extension = $attachment->getClientOriginalExtension();
                $fileName = time().rand(0, 100).".".$extension;
                $attachment->move(public_path('uploads/file'), $fileName); 
                $url = URL::asset('uploads/file/'.$fileName);

                $data['attachment'] = $url;
            }

            return $this->bookingRepository->create($data);
          } catch (\Exception $e) {
            throw $e;
          }
    }
}
