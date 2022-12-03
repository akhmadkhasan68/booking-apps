<?php

namespace App\Http\Controllers\Api\Room;

use App\Http\Controllers\Controller;
use App\Http\Repositories\RoomRepository;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    protected $roomReposiory;

    public function __construct(RoomRepository $roomReposiory)
    {
        $this->roomReposiory = $roomReposiory;
    }

    public function all() {
        $data = $this->roomReposiory->all();

        return response($data);
    }
    
    public function paginate() {
        $data = $this->roomReposiory->paginate();

        return response($data);
    }
    
    public function detail($id) {
        $data = $this->roomReposiory->findOneOrFail(['id' => $id]);

        return response($data);
    }
}
