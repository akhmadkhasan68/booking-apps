<?php

namespace App\Http\Controllers\Api\Room;

use App\Http\Controllers\Controller;
use App\Http\Repositories\RoomRepository;
use App\Http\Requests\PaginateRequest;
use App\Http\Requests\Room\BookingRequest;
use App\Http\Requests\Room\SearchAvailableRequest;

class RoomController extends Controller
{
    protected $roomRepository;

    public function __construct(RoomRepository $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }
    
    public function paginate(PaginateRequest $request) {
        $data = $this->roomRepository->paginate($request);

        return response($data);
    }
    
    public function searchAvailable(SearchAvailableRequest $request) {
        $data = $this->roomRepository->searchAvailable($request);

        return response($data);
    }

    public function detail($id) {
        try {
            $data = $this->roomRepository->findOneOrFail(['id' => $id]);
    
            return response($data);
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], $e->getCode());
        }
    }
}
