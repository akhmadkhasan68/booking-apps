<?php
namespace App\Http\Repositories;

use App\Http\Requests\PaginateRequest;
use App\Models\Room;
use App\Traits\PaginateTrait;

class RoomRepository {
  use PaginateTrait;

  protected $roomMember;

  public function __construct()
  {
    $this->roomMember = new Room();
  }

  public function paginate(PaginateRequest $request) {
    $data = $this->roomMember->query();

    return PaginateTrait::make([
        'name',
        'floor',
        'capacity',
    ], $request, $data);
  }

  public function findOneOrFail(array $where) {
    return $this->roomMember->with(['feedbacks', 'facilities'])->where($where)->firstOrFail();
  }
}