<?php
namespace App\Http\Repositories;

use App\Models\Room;

class RoomRepository {
  protected $roomMember;

  public function __construct()
  {
    $this->roomMember = new Room();
  }

  public function paginate() {
    return $this->roomMember->paginate();
  }

  public function all() {
    return $this->roomMember->get();
  }

  public function findOneOrFail(array $where) {
    return $this->roomMember->with(['feedbacks', 'facilities'])->where($where)->firstOrFail();
  }
}