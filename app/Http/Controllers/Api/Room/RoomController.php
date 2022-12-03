<?php

namespace App\Http\Controllers\Api\Room;

use App\Http\Controllers\Controller;
use App\Http\Repositories\RoomRepository;
use App\Http\Requests\PaginateRequest;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    protected $roomReposiory;

    public function __construct(RoomRepository $roomReposiory)
    {
        $this->roomReposiory = $roomReposiory;
    }
    
    public function paginate(PaginateRequest $request) {
        $data = $this->roomReposiory->paginate($request);

        return response($data);
    }
    
    public function detail($id) {
        $data = $this->roomReposiory->findOneOrFail(['id' => $id]);

        return response($data);
    }
}
